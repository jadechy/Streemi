<?php

namespace App\Controller\Photo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PhotoController extends AbstractController
{
    #[Route('/photo', name: 'photo')]
    public function photo(): Response
    {
        return $this->render('photo/upload.html.twig');
    }
}
