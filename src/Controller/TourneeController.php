<?php

namespace App\Controller;

use App\Entity\Tournee;
use App\Form\TourneeType;
use App\Repository\TourneeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tournee')]
class TourneeController extends AbstractController
{
    #[Route('/', name: 'app_tournee_index', methods: ['GET'])]
    public function index(TourneeRepository $tourneeRepository): Response
    {
        return $this->render('tournee/index.html.twig', [
            'tournees' => $tourneeRepository->findAll(),
        ]);
    }

    #[Route('/front', name: 'front_tournee_index', methods: ['GET'])]
    public function Frontindex(TourneeRepository $tourneeRepository): Response
    {
        return $this->render('tournee/frontindex.html.twig', [
            'tournees' => $tourneeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tournee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tournee = new Tournee();
        $form = $this->createForm(TourneeType::class, $tournee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tournee);
            $entityManager->flush();

            $this->addFlash('success', 'Tournee created successfully.');

            return $this->redirectToRoute('app_tournee_index');
        }

        return $this->render('tournee/new.html.twig', [
            'tournee' => $tournee,
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/{id}', name: 'app_tournee_show', methods: ['GET'])]
    public function show(Tournee $tournee): Response
    {
        return $this->render('tournee/show.html.twig', [
            'tournee' => $tournee,
        ]);
    }

    #[Route('/front/{id}', name: 'front_tournee_show', methods: ['GET'])]
    public function Frontshow(Tournee $tournee): Response
    {
        return $this->render('tournee/frontshow.html.twig', [
            'tournee' => $tournee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tournee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tournee $tournee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TourneeType::class, $tournee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Tournee updated successfully.');

            return $this->redirectToRoute('app_tournee_index');
        }

        return $this->render('tournee/edit.html.twig', [
            'tournee' => $tournee,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_tournee_delete', methods: ['POST'])]
    public function delete(Request $request, Tournee $tournee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tournee);
            $entityManager->flush();

            $this->addFlash('success', 'Tournee deleted successfully.');
        }

        return $this->redirectToRoute('app_tournee_index');
    }
    

    

    

}
  

