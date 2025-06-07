<?php

namespace Fv\FantasyVerse\Controller;

use Fv\FantasyVerse\Entity\Evento;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CalendarioController extends AbstractController
{
    #[Route('/calendario', name: 'calendario_index')]
    public function index(): Response
    {
        return $this->render('calendario/index.html.twig');
    }

    #[Route('/api/eventos', name: 'api_eventos')]
    public function eventos(EntityManagerInterface $em): JsonResponse
    {
        $eventos = $em->getRepository(Evento::class)->findAll();
        $data = [];

        foreach ($eventos as $evento) {
            $data[] = [
                'id' => $evento->getid(),
                'title' => $evento->gettitulo(),
                'start' => $evento->getfecha()->format('Y-m-d'),
                'color' => match ($evento->gettipo()) {
                    'disponible' => '#40c057',
                    'no_disponible' => '#fa5252',
                    default => '#339af0'
                },
                'tipo' => $evento->gettipo(),
                'isOwner' => $evento->getusuario() === $this->getUser()
            ];
        }

        return new JsonResponse($data);
    }



    #[Route('/api/evento', name: 'api_evento_crear', methods: ['POST'])]
    public function crear_evento(Request $request, EntityManagerInterface $em): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (!isset($data['tipo'], $data['fecha'])) {
                return new JsonResponse(['error' => 'Datos incompletos'], 400);
            }

            $usuario = $this->getUser();
            if (!$usuario) {
                return new JsonResponse(['error' => 'Usuario no autenticado'], 403);
            }

            $fecha = new \DateTime($data['fecha']);
            $tipo = $data['tipo'];

            $repo = $em->getRepository(Evento::class);

            if (in_array($tipo, ['disponible', 'no_disponible'])) {
                $existente = $repo->createQueryBuilder('e')
                    ->andWhere('e.usuario = :usuario')
                    ->andWhere('e.fecha >= :inicio AND e.fecha < :fin')
                    ->andWhere('e.tipo IN (:tipos)')
                    ->setParameter('usuario', $usuario)
                    ->setParameter('inicio', (clone $fecha)->setTime(0, 0))
                    ->setParameter('fin', (clone $fecha)->modify('+1 day')->setTime(0, 0))
                    ->setParameter('tipos', ['disponible', 'no_disponible'])
                    ->getQuery()
                    ->getOneOrNullResult();

                if ($existente) {
                    if ($existente->get_tipo() === $tipo) {
                        return new JsonResponse(['error' => 'Ya marcaste ese estado.'], 400);
                    } else {
                        $em->remove($existente);
                        $em->flush();
                    }
                }
            }

            $evento = new Evento();
            $evento->settipo($tipo);
            $evento->setfecha($fecha);
            $evento->setusuario($usuario);

            if ($tipo === 'evento') {
                $evento->settitulo($data['titulo'] ?? 'Evento sin título');
                $evento->setdescripcion($data['descripcion'] ?? null);
            } else {
                $evento->settitulo($tipo === 'disponible' ? 'Disponible' : 'No disponible');
            }

            $em->persist($evento);
            $em->flush();

            return new JsonResponse(['success' => true]);
        } catch (\Throwable $e) {
            return new JsonResponse([
                'error' => 'Excepción: ' . $e->getMessage()
            ], 500);
        }
    }

    #[Route('/api/evento/{id}', name: 'api_evento_editar', methods: ['PUT'])]
        public function editar_evento(int $id, Request $request, EntityManagerInterface $em): JsonResponse
        {
            $evento = $em->getRepository(Evento::class)->find($id);
            if (!$evento) return new JsonResponse(['error' => 'No encontrado'], 404);
            if ($evento->getusuario() !== $this->getUser()) return new JsonResponse(['error' => 'No autorizado'], 403);

            $data = json_decode($request->getContent(), true);
            $nuevoTitulo = $data['titulo'] ?? null;
            if (!$nuevoTitulo) return new JsonResponse(['error' => 'Título requerido'], 400);

            if ($evento->gettipo() === 'evento') {
                $evento->settitulo($nuevoTitulo);
                $em->flush();
            }

            return new JsonResponse(['success' => true]);
}



    #[Route('/api/evento/{id}', name: 'api_evento_borrar', methods: ['DELETE'])]
    public function borrar_evento(int $id, EntityManagerInterface $em): JsonResponse
    {
        $evento = $em->getRepository(Evento::class)->find($id);
        if (!$evento) {
            return new JsonResponse(['error' => 'Evento no encontrado'], 404);
        }

        $usuario = $this->getUser();
        if ($evento->getusuario() !== $usuario) {
            return new JsonResponse(['error' => 'No puedes borrar este evento'], 403);
        }

        $em->remove($evento);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/api/evento/borrar-dia', name: 'api_evento_borrar_dia', methods: ['POST'])]
    public function borrar_eventos_del_dia(Request $request, EntityManagerInterface $em): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (!isset($data['fecha'])) {
                return new JsonResponse(['error' => 'Fecha no proporcionada'], 400);
            }

            $usuario = $this->getUser();
            if (!$usuario) {
                return new JsonResponse(['error' => 'No autenticado'], 403);
            }

            $fecha = new \DateTime($data['fecha']);

            $repo = $em->getRepository(Evento::class);
            $eventos = $repo->createQueryBuilder('e')
                ->andWhere('e.usuario = :usuario')
                ->andWhere('e.fecha >= :inicio AND e.fecha < :fin')
                ->setParameter('usuario', $usuario)
                ->setParameter('inicio', (clone $fecha)->setTime(0, 0))
                ->setParameter('fin', (clone $fecha)->modify('+1 day')->setTime(0, 0))
                ->getQuery()
                ->getResult();


            foreach ($eventos as $evento) {
                $em->remove($evento);
            }

            $em->flush();
            return new JsonResponse(['success' => true]);
        } catch (\Throwable $e) {
            return new JsonResponse([
                'error' => 'Excepción: ' . $e->getMessage()
            ], 500);
        }
    }


}
