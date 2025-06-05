<?php

namespace Fv\FantasyVerse\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Fv\FantasyVerse\Entity\Personaje;
use Fv\FantasyVerse\Repository\PersonajeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetPersonajeController extends AbstractController
{
    public function __invoke(PersonajeRepository $personajeRepository): Response
    {
        
        dump($personajeRepository->findAll());

        return $this->render("views/home.html.twig");
    }
}
