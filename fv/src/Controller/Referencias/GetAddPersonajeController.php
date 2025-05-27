<?php

namespace Fv\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Fv\Entity\Personaje;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetAddPersonajeController extends AbstractController
{
    public function __invoke(EntityManagerInterface $entityManagerInterface): Response
    {
        $nuevoPersonaje = new Personaje();
        $nuevoPersonaje->setNombre('Runa');
        $nuevoPersonaje->setCa( 12);

        $entityManagerInterface->persist($nuevoPersonaje);
        $entityManagerInterface->flush();


        return $this->render("views/home.html.twig");
    }
}
