<?php

namespace App\Controller;

use App\Entity\CategorieH;
use App\Form\CategorieHType;
use App\Repository\CategorieHRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie/h')]
class CategorieHController extends AbstractController
{
    #[Route('/', name: 'app_categorie_h_index', methods: ['GET'])]
    public function index(CategorieHRepository $categorieHRepository): Response
    {
        return $this->render('categorie_h/index.html.twig', [
            'categorie_hs' => $categorieHRepository->findAll(),
        ]);
    }

    #[Route('/showFront', name: 'front_categorie_index', methods: ['GET'])]
    public function Frontindex(CategorieHRepository $categorieHRepository): Response
    {
        return $this->render('categorie_h/frontIndex.html.twig', [
            'categorie_hs' => $categorieHRepository->findAll(),
        ]);
    }
    


    #[Route('/new', name: 'app_categorie_h_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieH = new CategorieH();
        $form = $this->createForm(CategorieHType::class, $categorieH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieH);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_h_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_h/new.html.twig', [
            'categorie_h' => $categorieH,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_h_show', methods: ['GET'])]
    public function show(CategorieH $categorieH): Response
    {
        return $this->render('categorie_h/show.html.twig', [
            'categorie_h' => $categorieH,
        ]);
    }

    #[Route('/showFront/{id}', name: 'app_categorie_h_show22', methods: ['GET'])]
    public function Frontshow(CategorieH $categorieH): Response
    {
        return $this->render('categorie_h/Frontshow.html.twig', [
            'categorie_h' => $categorieH,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_categorie_h_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieH $categorieH, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieHType::class, $categorieH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_h_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_h/edit.html.twig', [
            'categorie_h' => $categorieH,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_h_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieH $categorieH, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieH->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorieH);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_h_index', [], Response::HTTP_SEE_OTHER);
    }
}
