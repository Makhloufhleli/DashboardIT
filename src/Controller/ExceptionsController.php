<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExceptionsController extends AbstractController
{
    /**
     * @Route("/exceptions", name="exceptions")
     */
    public function index(): Response
    {
        return $this->render('exceptions/index.html.twig', [
            'controller_name' => 'ExceptionsController',
        ]);
    }
}
