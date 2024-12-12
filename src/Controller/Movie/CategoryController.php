<?php

namespace App\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Category;
use App\Entity\Media;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractController
{
    #[Route('/discover', name: 'discover')]
    public function discover(CategoryRepository $categoryRepository, Request $request, ManagerRegistry $doctrine): Response
    {
        $media = $request->query->get('media');

        $categories = $categoryRepository->findAll();

        if($media){
            if($media == 'serie'){
                $mediasTendance = $doctrine->getRepository(Media::class)->findMostPopularMediasByType('serie');
            }else if($media == 'movie'){
                $mediasTendance = $doctrine->getRepository(Media::class)->findMostPopularMediasByType('movie');
            }
            return $this->render('category/discover.html.twig',[
                'categories' => $categories,
                'media' => $media,
                'mediasTendance' => $mediasTendance
            ]);
        }else{
            $mediasTendance = $doctrine->getRepository(Media::class)->findMostPopularMediasByType('movie');

            return $this->render('category/discover.html.twig',[
                'categories' => $categories,
                'media' => 'movie',
                'mediasTendance' => $mediasTendance
            ]);
        }
    }

    #[Route('/category/{id}', name: 'category')]
    public function category(string $id, Category $category, CategoryRepository $categoryRepository,Request $request, ManagerRegistry $doctrine): Response
    {
        $media = $request->query->get('media');

        $categories = $categoryRepository->findAll();

        $categoryName = $category->getName();

        if($media){
            $mediasTendance = $doctrine->getRepository(Media::class)->findMostPopularMediasByTypeAndCategory($media,$categoryName);
            return $this->render('category/category.html.twig',[
                'categoryChose' => $category,
                'categories' => $categories,
                'media' => $media,
                'mediasTendance' => $mediasTendance
            ]);
        }else{
            $mediasTendance = $doctrine->getRepository(Media::class)->findMostPopularMediasByTypeAndCategory('movie',$categoryName);

            return $this->render('category/category.html.twig',[
                'categoryChose' => $category,
                'categories' => $categories,
                'media' => 'movie',
                'mediasTendance' => $mediasTendance
            ]);
        }
    }
}
