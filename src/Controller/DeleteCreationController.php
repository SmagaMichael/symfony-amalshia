<?php

namespace App\Controller;

use App\Entity\Creation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteCreationController extends AbstractController
{
    #[Route('/admin/delete/creation/{id}', name: 'delete_creation')]
    public function index(Creation $creation): Response
    {
               // Pour supprimer avec Doctrine
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->remove($creation);
               $entityManager->flush(); // DELETE FROM
       
               $this->addFlash('danger', 'La création a bien été supprimée');
       
               return $this->redirectToRoute('creation');
    }
}
