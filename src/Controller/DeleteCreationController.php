<?php

namespace App\Controller;

use App\Entity\Creation;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteCreationController extends AbstractController
{
    #[Route('/admin/delete/creation/{id}', name: 'delete_creation')]
    public function index(Creation $creation): Response
    {
               // Pour supprimer avec Doctrine
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->remove($creation);


               if ($creation->getPicture()) {
                // FileSystem permet de manipuler les fichiers
                $fs = new Filesystem();
                // On supprime l'ancienne image
                $fs->remove($this->getParameter('upload_directory').'/'.$creation->getPicture());
            }

         
               $entityManager->flush(); // DELETE FROM
       
               $this->addFlash('danger', 'La création a bien été supprimée');
       
               return $this->redirectToRoute('creation');
    }
}
