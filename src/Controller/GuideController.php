<?php

namespace App\Controller;

use App\Entity\Guide;
use App\Form\GuideType;
use App\Repository\GuideRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


#[Route('/guide')]
class GuideController extends AbstractController
{
    
    #[Route('/', name: 'app_guide_index', methods: ['GET'])]
    public function index(GuideRepository $guideRepository, Request $request,  PaginatorInterface $paginator): Response
    {
        $paginations = $paginator->paginate(
            $guideRepository->findAll(),
            $request->query->get('page', 1),
            3
        );
        return $this->render('guide/index.html.twig', [
            'paginations' => $paginations,
        ]);
    }
    #[Route('/statistics', name: 'guide_statistics', methods: ['GET'])]
    public function guideStatistics(GuideRepository $guideRepository): Response
    {
        $totalStatistics = $guideRepository->findGuideStatistics();
        $countryStatistics = $guideRepository->findGuideStatisticsByCountry();
        $topFiveGuides = $guideRepository->findTopFiveGuidesByTours();

        return $this->render('guide/statistics.html.twig', [
            'totalStatistics' => $totalStatistics,
            'countryStatistics' => $countryStatistics,
            'topFiveGuides' => $topFiveGuides,
        ]);
    }


    

    #[Route('/front', name: 'front_guide_index', methods: ['GET'])]
    public function Frontindex(GuideRepository $guideRepository): Response
    {
        return $this->render('guide/frontindex.html.twig', [
            'guides' => $guideRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_guide_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $guide = new Guide();
        $form = $this->createForm(GuideType::class, $guide);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($guide);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_guide_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('guide/new.html.twig', [
            'guide' => $guide,
            'form' => $form->createView(), // Pass form view instead of form object
        ]);
    }
    

    #[Route('/{id}', name: 'app_guide_show', methods: ['GET'])]
    public function show(Guide $guide): Response
    {
        return $this->render('guide/show.html.twig', [
            'guide' => $guide,
        ]);
    }
    

    #[Route('/front/{id}', name: 'front_guide_show', methods: ['GET'])]
    public function Frontshow(Guide $guide): Response
    {
        return $this->render('guide/frontshow.html.twig', [
            'guide' => $guide,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_guide_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Guide $guide, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GuideType::class, $guide);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_guide_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('guide/edit.html.twig', [
            'guide' => $guide,
            'form' => $form->createView(), // Pass form view instead of form object
        ]);
    }
    

    #[Route('/{id}', name: 'app_guide_delete', methods: ['POST'])]
    public function delete(Request $request, Guide $guide, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guide->getId(), $request->request->get('_token'))) {
            $entityManager->remove($guide);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_guide_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
