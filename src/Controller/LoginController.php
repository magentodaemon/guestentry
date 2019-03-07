<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    public function login()
    {
        return $this->render('index/login.html.twig', []);
    }
}