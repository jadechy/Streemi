<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route(path: '/', name: 'admin_homepage')]
    public function admin(): Response
    {
        return $this->render('admin/admin.html.twig');
    }

    #[Route('/users', name: 'admin_users')]
    public function adminUsers(): Response
    {
        return $this->render('admin/admin_users.html.twig');
    }

    #[Route('/movies', name: 'admin_movies')]
    public function adminMovies(): Response
    {
        return $this->render('admin/admin_films.html.twig');
    }

    #[Route('/movies/add', name: 'admin_add_movies')]
    public function adminAddMovies(): Response
    {
        return $this->render('admin/admin_add_films.html.twig');
    }
}
