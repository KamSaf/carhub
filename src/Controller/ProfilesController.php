<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilesController extends AbstractController
{
    #[Route('/profile', name: 'user_profile')]
    public function index(): Response
    {
        return $this->render('profiles_templates/profile.html.twig');
    }
}
