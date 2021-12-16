<?php

namespace App\Controller;

use App\Repository\CreationRepository;
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

    // #[Route('/creation', name: 'creation')]
    /**
     * @Route("/creation", name="creation")
     */
    public function index(CreationRepository $creationRepository): Response
    {

        $creations = $creationRepository->findAll();

        return $this->render('creation/index.html.twig', [
            'creations' =>  $creations,
        ]);
    }
}
