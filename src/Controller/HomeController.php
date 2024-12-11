<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Media;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(Request $request, ManagerRegistry $doctrine): Response
    {
        $media = $request->query->get('media');

        $mediasTendance = $doctrine->getRepository(Media::class)->findPopular();

        if($media){
            return $this->render('home/index.html.twig', [
                'media' => $media,
                'mediasTendance' => $mediasTendance
            ]);
        }else{
            return $this->render('home/index.html.twig', [
                'media' => 'movie',
                'mediasTendance' => $mediasTendance
            ]);
        }
    }
}
