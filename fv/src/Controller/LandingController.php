<?php
// src/Controller/LandingController.php
namespace Fv\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LandingController extends AbstractController
{
    public function index(): Response
    {
        $campaigns = [
            [
                'title' => 'La Sombra de Hylia',
                'description' => 'Una épica batalla contra un antiguo mal.',
                'image' => '/images/horda.png'
            ],
            [
                'title' => 'Misterios de Hyrule', 
                'description' => 'Explora las ruinas de una civilización perdida.', 
                'image' => '/images/logo FE.png'
            ],
            [
                'title' => 'Guerra del cataclismo', 
                'description' => 'Forja alianzas y defiende Hyrule en su momoento mas bajo.', 
                'image' => '/images/hyrule.jpg'
            ],
        ];

        return $this->render('landing.html.twig', ['campaigns' => $campaigns]);
    }
}