<?php

namespace App\Controller;

use App\Entity\Flights;
use App\Form\FlightsType;
use App\Repository\FlightsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/flights')]
class FlightsController extends AbstractController
{
    #[Route('/', name: 'app_flights_index', methods: ['GET'])]
    public function index(FlightsRepository $flightsRepository): Response
    {
        return $this->render('flights/index.html.twig', [
            'flights' => $flightsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_flights_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, FlightsRepository $flightsRepository): Response
    {
        $flight = new Flights();
        $form = $this->createForm(FlightsType::class, $flight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flightsRepository->save($flight, true);

            return $this->redirectToRoute('app_flights_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('flights/new.html.twig', [
            'flight' => $flight,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_flights_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(Flights $flight): Response
    {
        return $this->render('flights/show.html.twig', [
            'flight' => $flight,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_flights_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Flights $flight, FlightsRepository $flightsRepository): Response
    {
        $form = $this->createForm(FlightsType::class, $flight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flightsRepository->save($flight, true);

            return $this->redirectToRoute('app_flights_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('flights/edit.html.twig', [
            'flight' => $flight,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_flights_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Flights $flight, FlightsRepository $flightsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flight->getId(), $request->request->get('_token'))) {
            $flightsRepository->remove($flight, true);
        }

        return $this->redirectToRoute('app_flights_index', [], Response::HTTP_SEE_OTHER);
    }
}
