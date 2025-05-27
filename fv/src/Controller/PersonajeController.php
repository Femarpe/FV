<?php

namespace Fv\Controller;

use Fv\Entity\Personaje;
use Fv\Repository\PersonajeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/personajes')]
class PersonajeController extends AbstractController
{
    #[Route('/', name: 'personaje_index')]
    public function index(PersonajeRepository $repo): Response
    {
        $usuario = $this->getUser();
        $personajes = $repo->findBy(['jugador' => $usuario->getUserIdentifier()]);

        return $this->render('personaje/index.html.twig', [
            'personajes' => $personajes,
        ]);
    }
}
