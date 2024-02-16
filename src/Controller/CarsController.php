<?php

namespace App\Controller;

use DateTime;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/home', name: 'home')]
    public function home(): Response
    {
        return $this->render('cars_templates/home.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route('/time', name: 'time')]
    public function time(): JsonResponse
    {
        // $tz = new DateTimeZone(date_default_timezone_get());

        $date = new DateTime(date("Y-m-d H:i:s"));
        // $date = new DateTime(date("Y-m-d\\TH:i:sP"));
        // $date2 = $date->setTimezone($tz);
        // $date2 = $date->setTimezone($tz);
        // $date2 = $date2->format('l F j Y g:i:s A I');
        // $date = $date->format('l F j Y g:i:s A I');
        return $this->json([
            'date1' => $date,
        ]);
    }
}
