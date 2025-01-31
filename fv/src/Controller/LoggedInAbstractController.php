<?php

namespace Fv\Controller;

use Fv\Exception\NotLoggedInException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class LoggedInAbstractController extends AbstractController
{
    public function __construct()
    {
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            $this->redirectToRoute('login');
        }
    }
}