<?php

namespace App\Controller\List;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Playlist;
use App\Entity\PlaylistSubscription;

class ListController extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function list(ManagerRegistry $doctrine, Request $request): Response
    {
        $playlistId = $request->query->get('playlist');

        if ($playlistId) {
            $playlistChose = $doctrine->getRepository(Playlist::class)->find($playlistId);
        } else {
            $playlistChose = null;
        }

        $playlists = $doctrine->getRepository(Playlist::class)->findAll();

        $playlistsSubscriptions = $doctrine->getRepository(PlaylistSubscription::class)->findAll();

        return $this->render('list/lists.html.twig', [
            'playlistChose' => $playlistChose,
            'playlists' => $playlists,
            'playlistsSubscriptions' => $playlistsSubscriptions,
        ]);
    }
}
