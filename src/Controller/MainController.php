<?php

namespace App\Controller;

use App\Repository\FlightsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function home(FlightsRepository $flightsRepository): Response
    {
        return $this->render('main/home.html.twig', [
            'flights' => $flightsRepository->findAll(),
        ]);
    }
}
