<?php

namespace Fv\FantasyVerse\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Fv\FantasyVerse\Repository\PersonajeRepository;
use Fv\FantasyVerse\Repository\CampanyaRepository;
use Fv\FantasyVerse\Repository\EventoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Fv\FantasyVerse\Entity\Evento;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('', name: 'admin_dashboard')]
    public function index(
        PersonajeRepository $personajeRepo,
        CampanyaRepository $campanyaRepo,
        EventoRepository $eventoRepo
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        

        return $this->render('admin/index.html.twig', [
            'personajes' => $personajeRepo->findAll(),
            'campanyas' => $campanyaRepo->findAll(),
            'eventos' => $eventoRepo->findAll(),
        ]);
    }

    #[Route('/personajes', name: 'admin_personajes')]
    public function personajes(PersonajeRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/personajes.html.twig', [
            'personajes' => $repo->findAll(),
        ]);
    }

    #[Route('/campanyas', name: 'admin_campanyas')]
    public function campanyas(CampanyaRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/campanyas.html.twig', [
            'campanyas' => $repo->findAll(),
        ]);
    }

    #[Route('/eventos', name: 'admin_eventos')]
    public function eventos(EventoRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/eventos.html.twig', [
            'eventos' => $repo->findAll(),
        ]);
    }
    
    #[Route('/admin/eventos/borrar/{id}', name: 'admin_evento_borrar')]
    public function borrarConfirmacion(Evento $evento): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/evento/eventoBorrar.html.twig', [
            'evento' => $evento,
        ]);
    }

    #[Route('/admin/eventos/borrar/{id}/confirmado', name: 'admin_evento_borrar_confirmado', methods: ['POST'])]
    public function borrarConfirmado(Evento $evento, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em->remove($evento);
        $em->flush();

        $this->addFlash('success', '✅ Evento eliminado correctamente.');
        return $this->redirectToRoute('admin_eventos');
    }
    

    #[Route('/usuarios', name: 'admin_usuarios')]
    public function usuarios(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // Aquí podrías implementar la lógica para listar usuarios, si es necesario.
        // Por ahora, simplemente redirigimos a la página de inicio del admin.
        return $this->redirectToRoute('admin_dashboard');
    }


}
