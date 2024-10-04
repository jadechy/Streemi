<?php

namespace App\Controller\Discover;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DiscoverController extends AbstractController
{
    #[Route('/discover', name: 'discover')]
    public function discover(): Response
    {
        return $this->render('discover/discover.html.twig');
    }
}
