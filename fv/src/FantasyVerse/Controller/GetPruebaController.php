<?php

namespace Fv\FantasyVerse\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetPruebaController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render("prueba.html.twig");
    }
}

