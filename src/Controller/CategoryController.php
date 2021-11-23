<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/admin/add/category', name: 'add_category')]
    public function create(): Response
    {
        return $this->render('category/create.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }


    #[Route('/admin/edit/category/{id}', name: 'edit_category')]
    public function edit(): Response
    {
        return $this->render('category/edit.html.twig', [
            'controller_name' => 'CategoryController',
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
