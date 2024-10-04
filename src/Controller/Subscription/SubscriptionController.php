<?php

namespace App\Controller\Subscription;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'subscription')]
    public function subscription(): Response
    {
        return $this->render('subscription/abonnements.html.twig');
    }
}
