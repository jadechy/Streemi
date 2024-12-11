<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(Request $request): Response
    {
        $media = $request->query->get('media');

        if($media){
            return $this->render('home/index.html.twig', [
                'media' => $media
            ]);
        }else{
            return $this->render('home/index.html.twig', [
                'media' => 'movie',
            ]);
        }

        return $this->render('home/index.html.twig');
    }
}
