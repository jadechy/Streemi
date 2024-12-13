<?php

namespace App\Controller\Upload;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UploadRepository;

class UploadController extends AbstractController
{
    #[Route('/upload', name: 'upload')]
    public function upload(UploadRepository $uploadRepository): Response
    {
        return $this->render('upload/upload.html.twig',[
            'uploads' => $uploadRepository->findAll(),
        ]);
    }
}
