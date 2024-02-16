<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Form\ProfileDataFormType;

class ProfilesController extends AbstractController
{
    #[Route('/profile', name: 'user_profile')]
    public function index(UserInterface $user): Response
    {
        // GET request
        $form = $this->createForm(ProfileDataFormType::class, $user);

        return $this->render('profiles_templates/profile.html.twig', [
            'profileEditForm' => $form->createView(),
        ]);
    }
}
