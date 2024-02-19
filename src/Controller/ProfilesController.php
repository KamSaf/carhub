<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileDataFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfilesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/profile', name: 'user_profile')]
    public function index(UserInterface $user): Response
    {
        // GET request
        $form = $this->createForm(ProfileDataFormType::class, $user);

        return $this->render('profiles_templates/profile.html.twig', [
            'profileEditForm' => $form->createView(),
        ]);
    }
    
    #[Route('/edit_profile', name: 'edit_profile', methods: ['POST'])]
    public function editProfile(Request $request, UserPasswordHasherInterface $userPasswordHasher): JsonResponse
    {
        // POST request

        /** @var User $user */
        $user = $this->getUser();
        if (!$user) { // check if user is logged in
            return $this->json([
                'status' => 'failed',
                'errors' => '404',
            ]);
        }
        $form = $this->createForm(ProfileDataFormType::class, $user);
        $form->handleRequest($request);
        $formIsValid = $form->isValid();

        // if form is submitted but the data is invalid
        if ($form->isSubmitted() && !$formIsValid) {
            return $this->json([
                'status' => 'failed',
                'errors' => strval($form->getErrors(true)),
            ]);
        }

        // if form is submitted and the data is valid
        if ($form->isSubmitted() && $formIsValid) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setTimezone($form->get('newTimezone')->getData());

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->json([
                'status' => 'success',
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'password' => $user->getPassword(),
                'timezone' => $user->getTimezone(),
            ]);
        }
    }
}
