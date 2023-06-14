<?php

namespace App\Controller;

use App\Entity\Cities;
use App\Form\CitiesType;
use App\Repository\CitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[Route('/cities')]
class CitiesController extends AbstractController 
{
    #[Route('/new', name: 'app_cities_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, CitiesRepository $citiesRepository) : Response 
    {
        $cities = new Cities();
        $form = $this->createForm(CitiesType::class, $cities);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $citiesRepository->save($cities, true);

            return $this->redirectToRoute('app_flights_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cities/new.html.twig', [
            'flight' => $cities,
            'form' => $form,
        ]);
    }

}