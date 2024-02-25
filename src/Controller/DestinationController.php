<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Form\DestinationType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DestinationRepository;

class DestinationController extends AbstractController
{
    #[Route('/destination', name: 'app_destination')]
    public function index(DestinationRepository $destinationRepository,Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $destinationRepository->paginatonQuery(),
            $request->query->get('page',1),
            8
        );

        return $this->render('destination/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    #[Route('/show_destination', name: 'app_destinations')]
    public function destinations(DestinationRepository $destinationRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $destinationRepository->paginatonQuery(),
            $request->query->get('page',1),
            6
        );

        return $this->render('destination/destinations.html.twig', [
            'pagination' => $pagination
        ]);
    }

    #[Route('/destination/new', name: 'app_destination_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $destination = new Destination();
        $form = $this->createForm(DestinationType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($destination);
            $entityManager->flush();

            return $this->redirectToRoute('app_destination');
        }

        return $this->render('destination/new.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    #[Route('/destination/edit/{id}', name: 'app_destination_edit')]
    public function edit(Request $request, $id, EntityManagerInterface $entityManager, DestinationRepository $destinationRepository): Response
    {
        $destination = $destinationRepository->find($id);

        if (!$destination) {
            throw $this->createNotFoundException('Destination not found');
        }

        $form = $this->createForm(DestinationType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_destination');
        }

        return $this->render('destination/edit.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/destination/show/{id}', name: 'app_destination_show')]
    public function show($id, DestinationRepository $destinationRepository): Response
    {
        $destination = $destinationRepository->find($id);

        if (!$destination) {
            throw $this->createNotFoundException('Destination not found');
        }

        return $this->render('destination/show.html.twig', [
            'destination' => $destination,
        ]);
    }

    #[Route('/destination/details/{id}', name: 'app_destination_details_show')]
    public function showdetails($id, DestinationRepository $destinationRepository): Response
    {
        $destination = $destinationRepository->find($id);

        if (!$destination) {
            throw $this->createNotFoundException('Destination not found');
        }

        return $this->render('destination/destinationDetails.html.twig', [
            'destination' => $destination,
        ]);
    }


    #[Route('/destination/delete/{id}', name: 'app_destination_delete')]
    public function delete(Request $request, $id, EntityManagerInterface $entityManager, DestinationRepository $destinationRepository): Response
    {
        $destination = $destinationRepository->find($id);

        if (!$destination) {
            throw $this->createNotFoundException('Destination not found');
        }

        $entityManager->remove($destination);
        $entityManager->flush();

        return $this->redirectToRoute('app_destination');
    }
    #[Route('/Destination_map', name: 'map')]
    public function renderMap(DestinationRepository $destinationRepository): Response
    {
        $destinations = $destinationRepository->findAll();

        $countryCounts = [];
        foreach ($destinations as $destination) {
            $country = $destination->getAbbrev();
            if (!isset($countryCounts[$country])) {
                $countryCounts[$country] = 0;
            }
            $countryCounts[$country]++;
        }

        return $this->render('destination/map.html.twig', [
            'countryCounts' => $countryCounts,
        ]);
    }
}
