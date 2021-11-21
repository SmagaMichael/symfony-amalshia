<?php

namespace App\Controller;

use App\Entity\Creation;
use App\Form\AddCreationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddCreationController extends AbstractController
{
    #[Route('/add/creation', name: 'add_creation')]
    public function create(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        $creation = new Creation();


        $form = $this->createForm(AddCreationFormType::class, $creation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $slug = $slugger->slug($creation->getTitle())->lower(); 
            $creation->setSlug($slug);

            //__________________UPLOAD IMAGE___________________________________________
            /** @var UploadedFile $image */
            $image = $form->get('picture')->getData();
            if ($image) {
                $filename = $creation->getTitle(). uniqid() . '.' . $image->guessExtension();
                $image->move($this->getParameter('upload_directory'), $filename);
                $creation->setPicture($filename);
            } else {
                $creation->setPicture('default.png');
            }
            //_________________________________________________________________________


            $manager->persist($creation);
            $manager->flush();
            $this->addFlash('success', 'votre création ' . $creation->getTitle() . ' a bien été ajoutée');
            return $this->redirecttoRoute('creation');
        }

        return $this->render('add_creation/index.html.twig', [
            'AddCreationFormType' => $form->createView(),
        ]);
    }
}
