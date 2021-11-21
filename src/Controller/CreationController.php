<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationController extends AbstractController
{

    /*
     * Un entité création doit avoir : 
     *  - un titre
     *  - un slug par rapport au titre 
     *  - une image
     *  - une date        qui peut etre nulle
     *  - une description qui peut être nulle
     * 
     *  - une catégorie mais a mettre plus tard
     */

    #[Route('/creation', name: 'creation')]
    public function index(): Response
    {
        return $this->render('creation/index.html.twig', [
            'controller_name' => 'CreationController',
        ]);
    }
}
