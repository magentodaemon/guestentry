<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController
{
    public function list()
    {
        return $this->render('list/list.html.twig', []);
    }

    public function add()
    {
        return $this->render('list/add.html.twig',[]);
    }
}