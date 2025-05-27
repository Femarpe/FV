<?php

namespace Fv\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'ruta_admin')]
    public function index(): Response
    {
        return new Response('<h1>Bienvenido al panel de administración</h1>');
    }
}
