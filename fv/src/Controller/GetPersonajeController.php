<?php

namespace Fv\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Fv\Entity\Personaje;
use Fv\Repository\PersonajeRepository;
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
