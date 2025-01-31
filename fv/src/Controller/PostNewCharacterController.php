<?php

namespace Fv\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Fv\Entity\Character;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostNewCharacterController extends AbstractController
{
    public function __invoke(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $params = $request->request->all();

        $this->checkParams($params);

        $character = new Character();
        $character->setName($params['nombre']);
        $character->setCa($params['ca']);
        $character->setHealth($params['vida']);

        $entityManager->persist($character);
        $entityManager->flush();

        return $this->render("views/newCharacterCreated.html.twig");
    }

    private function checkParams(array $params)
    {
        if (
            !isset($params['nombre'])
            || !isset($params['ca'])
            || !isset($params['vida'])
        ) {
            throw new Exception('Missing mandatory param');
        }
    }
}