<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\AddCategoryFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    // #[Route('/admin/add/category', name: 'add_category')]
    /**
     * @Route("/admin/add/category", name="add_category")
     */
    public function create(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {

        $category = new Category;
        $form = $this->createForm(AddCategoryFormType::class, $category);

        $form->handleRequest($request);

        $formView = $form->createView();

        if ($form->isSubmitted()) {
            $category->setSlug(strtolower($slugger->slug($category->getName())));
            $manager->persist($category);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('category/create.html.twig', [
            'AddCategoryFormType' => $formView,
        ]);
    }




    // #[Route('/admin/edit/category/{id}', name: 'edit_category')]
    /**
     * @Route("/admin/edit/category/{id}", name="edit_category")
     */
    public function edit(Request $request, $id, CategoryRepository $categoryRepository,EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {

        $category = $categoryRepository->find($id);
        $form = $this->createForm(AddCategoryFormType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $category->setSlug(strtolower($slugger->slug($category->getName())));
            $manager->persist($category);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'AddCategoryFormType' => $formView,
        ]);
    }

    // #[Route('/category/{slug}', name: 'show_category')]
    /**
     * @Route("/category/{slug}", name="show_category")
     */
    public function show($slug, CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->findOneBy([
            'slug' => $slug
        ]);

       if (!$category) {
           throw $this->createNotFoundException("La catégorie demandée n'existe pas");
       }

        return $this->render('category/show_category.html.twig', [
            'slug' => $slug,
            'category' => $category,
        ]);
    }

    // #[Route('/admin/delete/category/{id}', name: 'delete_category')]
    /**
     * @Route("/admin/delete/category/{id}", name="delete_category")
     */
    public function delete(Category $category): Response
    {

        // dd($category);
       $creations = $category->getCreations();
       foreach($creations as $creation){
        if ($creation->getPicture()) {
            // FileSystem permet de manipuler les fichiers
            $fs = new Filesystem();
            // On supprime l'ancienne image
            $fs->remove($this->getParameter('upload_directory').'/'.$creation->getPicture());
        }

       }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);

        


        $entityManager->flush(); 

        $this->addFlash('danger', 'La Catégorie a bien été supprimée');

        return $this->redirectToRoute('creation');
    }
}
