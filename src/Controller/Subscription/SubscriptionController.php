<?php

namespace App\Controller\Subscription;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

use App\Repository\SubscriptionRepository;

#[IsGranted('ROLE_USER')]
class SubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'subscription')]
    public function subscription(SubscriptionRepository $subscriptionRepository): Response
    {
        $subscriptions = $subscriptionRepository->findAll();

        return $this->render('subscription/abonnements.html.twig', [
            'subscriptions' => $subscriptions
        ]);
    }
}
