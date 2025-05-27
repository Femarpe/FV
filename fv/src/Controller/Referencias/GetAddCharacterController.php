<?php

namespace Fv\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Fv\Entity\Character;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetAddCharacterController extends AbstractController
{
    public function __invoke(EntityManagerInterface $entityManager): Response
    {
        $newCharacter = new Character();
        $newCharacter->setName('Hiro');
        $newCharacter->setHealth(20);
        $newCharacter->setCa(12);

        $entityManager->persist($newCharacter);
        $entityManager->flush();

        return $this->render("views/home.html.twig");
    }
}