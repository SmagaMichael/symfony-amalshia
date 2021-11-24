<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\AddCategoryFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryController extends AbstractController
{
    #[Route('/admin/add/category', name: 'add_category')]
    public function create(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {

        $category = new Category;
        $form = $this->createForm(AddCategoryFormType::class, $category);

        $form->handleRequest($request);

        $formView = $form->createView();

        if ($form->isSubmitted()) {
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('category/create.html.twig', [
            'AddCategoryFormType' => $formView,
        ]);
    }




    #[Route('/admin/edit/category/{id}', name: 'edit_category')]
    public function edit(Request $request, $id, CategoryRepository $categoryRepository, EntityManagerInterface $manager): Response
    {

        $category = $categoryRepository->find($id);
        $form = $this->createForm(AddCategoryFormType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        $formView = $form->createView();

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'AddCategoryFormType' => $formView,
        ]);
    }

    // #[Route('/admin/delete/category/{id}', name: 'category')]
    // public function delete(): Response
    // {
    //     return $this->render('category/index.html.twig', [
    //         'controller_name' => 'CategoryController',
    //     ]);
    // }
}
