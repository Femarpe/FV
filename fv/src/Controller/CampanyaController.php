<?php

namespace Fv\Controller;

use Fv\Entity\Campanya;
use Fv\Repository\CampanyaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class CampanyaController extends AbstractController
{
    #[Route('/campanyas', name: 'campanya_index')]
    public function index(CampanyaRepository $repo): Response
    {
        $usuario = $this->getUser()->getUserIdentifier();
        $campanyas = $repo->findBy(['creador' => $usuario]);

        return $this->render('campanya/index.html.twig', [
            'campanyas' => $campanyas
        ]);
    }

    #[Route('/campanyas/crear', name: 'crear_campanya')]
    public function crear(): Response
    {
        $campanya = new Campanya();
        $campanya->setNombre('');
        $campanya->setDescripcion('');
        $campanya->setCreador($this->getUser()->getUserIdentifier());
        $campanya->setResumenSesion('');
        $campanya->setEstadoActual('');
        $campanya->setLocalizacionActual('');
        $campanya->setDiaEnElCalendario('');
        $campanya->setNotasDirector('');

        return $this->render('campanya/campanya.html.twig', [
            'campanya' => $campanya
        ]);
    }

    #[Route('/campanyas/editar/{id}', name: 'editar_campanya')]
    public function editar(Uuid $id, EntityManagerInterface $em): Response
    {
        $campanya = $em->getRepository(Campanya::class)->find($id);

        if (!$campanya) {
            throw $this->createNotFoundException('Campaña no encontrada');
        }

        $usuario = $this->getUser()->getUserIdentifier();

        if ($campanya->getCreador() !== $usuario) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('campanya/campanya.html.twig', [
            'campanya' => $campanya
        ]);
    }

    #[Route('/campanyas/guardar/{id}', name: 'guardar_campanya')]
    public function guardar(?string $id, Request $request, EntityManagerInterface $em): Response
    
    {
        $usuario = $this->getUser()->getUserIdentifier();
        $campanya = null;
    
        if ($id && Uuid::isValid($id)) {
            $uuid = Uuid::fromString($id);
            $campanya = $em->getRepository(Campanya::class)->find($uuid);
        
            if (!$campanya) {
                $campanya = new Campanya();
                $campanya->setId($uuid);
                $campanya->setCreador($usuario);
            }
        
            if ($campanya->getCreador() !== $usuario) {
                throw $this->createAccessDeniedException();
            }
        } else {
            $campanya = new Campanya();
            $campanya->setCreador($usuario);
        }
        
    
        
    
        $campanya->setNombre($request->request->get('nombre'));
        $campanya->setDescripcion($request->request->get('descripcion'));
        $campanya->setResumenSesion($request->request->get('resumen_sesion'));
        $campanya->setEstadoActual($request->request->get('estado_actual'));
        $campanya->setLocalizacionActual($request->request->get('localizacion_actual'));
        $campanya->setDiaEnElCalendario($request->request->get('dia_en_el_calendario'));
        $campanya->setNotasDirector($request->request->get('notas_director'));
    
        $em->persist($campanya);
        $em->flush();
    
        return $this->redirectToRoute('campanya_index');
    }
    

    #[Route('/campanyas/eliminar/{id}', name: 'eliminar_campanya')]
    public function eliminar(Uuid $id, EntityManagerInterface $em): Response
    {
        $campanya = $em->getRepository(Campanya::class)->find($id);

        if (!$campanya) {
            throw $this->createNotFoundException('Campaña no encontrada');
        }

        $usuario = $this->getUser()->getUserIdentifier();

        if ($campanya->getCreador() !== $usuario) {
            throw $this->createAccessDeniedException();
        }

        $em->remove($campanya);
        $em->flush();

        return $this->redirectToRoute('campanya_index');
    }
}
