<?php

namespace App\Controller;

use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListController extends AbstractController
{
    /**
        #[IsGranted('ROLE_USER')]
    */
    #[Route('/lists', name: 'page_lists')]
    public function index(
        PlaylistRepository $playlistSubscriptionRepository,
        PlaylistRepository $playlistRepository,
        Request $request,
    ): Response {
        $myPlaylists = $playlistRepository->findAll();
        $subscribedPlaylists = $playlistSubscriptionRepository->findAll();

        $selectedPlaylistId = $request->query->get('playlist', null);
        if ($selectedPlaylistId) {
            $selectedPlaylist = $playlistRepository->find($selectedPlaylistId);
        } else {
            $selectedPlaylist = null;
        }

        return $this->render('movie/lists.html.twig', [
            'myPlaylists' => $myPlaylists,
            'subscribedPlaylists' => $subscribedPlaylists,
            'selectedPlaylist' => $selectedPlaylist,
        ]);
    }
}
