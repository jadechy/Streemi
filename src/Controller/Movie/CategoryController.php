<?php

namespace App\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractController
{
    #[Route('/discover', name: 'discover')]
    public function discover(CategoryRepository $categoryRepository, Request $request): Response
    {
        $media = $request->query->get('media');

        $categories = $categoryRepository->findAll();

        if($media){
            return $this->render('category/discover.html.twig',[
                'categories' => $categories,
                'media' => $media
            ]);
        }else{
            return $this->render('category/discover.html.twig',[
                'categories' => $categories,
                'media' => 'movie'
            ]);
        }
    }

    #[Route('/category/{id}', name: 'category')]
    public function category(string $id, Category $category, CategoryRepository $categoryRepository,Request $request): Response
    {
        $media = $request->query->get('media');

        $categories = $categoryRepository->findAll();

        if($media){
            return $this->render('category/category.html.twig',[
                'categoryChose' => $category,
                'categories' => $categories,
                'media' => $media
            ]);
        }else{
            return $this->render('category/category.html.twig',[
                'categoryChose' => $category,
                'categories' => $categories,
                'media' => 'movie'
            ]);
        }
    }
}
