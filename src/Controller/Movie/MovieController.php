<?php

namespace App\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Movie;
use App\Entity\Serie;

class MovieController extends AbstractController
{
    #[Route('/movie/{id}', name: 'show_movie')]
    public function movie(int $id, Movie $movie): Response
    {
        return $this->render('movie/detail.html.twig',[
            'movie' => $movie,
        ]);
    }

    #[Route('/serie/{id}', name: 'show_serie')]
    public function series(int $id, Serie $serie): Response
    {
        return $this->render('movie/detail_serie.html.twig',[
            'serie' => $serie,
        ]);
    }
}
