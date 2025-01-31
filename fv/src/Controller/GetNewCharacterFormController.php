<?php

namespace Fv\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetNewCharacterFormController extends LoggedInAbstractController
{
    public function __invoke(): Response
    {
        return $this->render("views/newCharacterForm.html.twig");
    }
}