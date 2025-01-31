<?php

namespace Fv\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Fv\Entity\Character;
use Fv\Repository\CharacterRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetCharactersController extends AbstractController
{
    public function __invoke(CharacterRepository $repository): Response
    {
        $characters = $repository->findAll();

        return $this->render(
            "views/listCharacters.html.twig",
            [
                'personajes' => $characters
            ]
        );
    }
}