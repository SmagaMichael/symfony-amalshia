<?php

namespace App\Controller;

use App\Entity\Creation;
use App\Form\AddCreationFormType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditCreationController extends AbstractController
{
    #[Route('/admin/edit/creation/{id}', name: 'edit_creation')]
    /**
     * @Route("/admin/edit/creation/{id}", name="edit_creation")
     */
    public function edit(Request $request, Creation $creation): Response
    {

        $form = $this->createForm(AddCreationFormType::class, $creation);
        $form->handleRequest($request);
        $imageExist = $form->getData()->getPicture();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('picture')->getData();
            if ($image) { // Si on upload une image 
                // On doit vérifier si une ancienne image est présente pour la supprimer

                if ($creation->getPicture()) {
                    // FileSystem permet de manipuler les fichiers
                    $fs = new Filesystem();
                    // On supprime l'ancienne image
                    $fs->remove($this->getParameter('upload_directory').'/'.$creation->getPicture());
                }

                $filename = uniqid() . '.' . $image->guessExtension();
                $image->move($this->getParameter('upload_directory'), $filename);
                $creation->setPicture($filename);
            }else{
                $creation->setPicture("$imageExist");
            }


            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le produit a bien été modifié');
            return $this->redirecttoRoute('creation');
        }



        return $this->render('creation/edit_creation.html.twig', [
            'AddCreationFormType' => $form->createView(),
            'Creation' => $creation,

        ]);
    }
}
