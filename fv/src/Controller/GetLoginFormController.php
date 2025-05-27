<?php

namespace Fv\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GetLoginFormController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function __invoke(AuthenticationUtils $authUtils): Response
    {
        return $this->render('usuario/login.html.twig', [
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ]);
    }
}
//euris.fm@gmail.com admin admin
//usuario@fv.local 1234 usuario
//invitado@fv.local 1234 invitado
