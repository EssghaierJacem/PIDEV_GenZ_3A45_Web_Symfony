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
use Symfony\Component\Mailer\MailerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Mime\Email;
use App\Form\TourSearchType;



#[Route('/tournee')]
class TourneeController extends AbstractController
{
    #[Route('/', name: 'app_tournee_index', methods: ['GET'])]
    public function index(TourneeRepository $tourneeRepository, Request $request, PaginatorInterface $paginator): Response
{
    // Récupérer le champ de tri à partir de la requête
    $sortField = $request->query->get('sortField', 'id');
    $sortOrder = $request->query->get('sortOrder', 'ASC');

    // Récupérer les tournées triées selon le champ et l'ordre spécifiés
    $tournees = $tourneeRepository->findAllSorted($sortField, $sortOrder);
    $pagination = $paginator->paginate(
        $tournees,
        $request->query->getInt('page', 1),
        5 // Nombre d'éléments par page
    );

    // Passer les données au template Twig
    return $this->render('tournee/index.html.twig', [
        'pagination' => $pagination,
        'sortField' => $sortField,
        'sortOrder' => $sortOrder,
    ]);
}

    #[Route('/front', name: 'front_tournee_index', methods: ['GET'])]
    public function Frontindex(TourneeRepository $tourneeRepository): Response
    {
        return $this->render('tournee/frontindex.html.twig', [
            'tournees' => $tourneeRepository->findAll(),
        ]);
    }
    #[Route('/searchB', name: 'app_tourneeB_search', methods: ['GET', 'POST'])]
    public function searchB(TourneeRepository $tourneeRepository, Request $request): Response
    {
        $form = $this->createForm(TourSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = $form->getData();

            // Utilisez $criteria pour filtrer les résultats de la recherche dans le repository
            $results = $tourneeRepository->findByCriteria($criteria);

            // Renvoyez les résultats de recherche à la vue
            return $this->render('tournee/search_resultsB.html.twig', [
                'results' => $results,
            ]);
        }

        // Affichez le formulaire de recherche
        return $this->render('tournee/searchB.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/search', name: 'app_tournee_search', methods: ['GET', 'POST'])]
    public function search(TourneeRepository $tourneeRepository, Request $request): Response
    {
        $form = $this->createForm(TourSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = $form->getData();

            // Utilisez $criteria pour filtrer les résultats de la recherche dans le repository
            $results = $tourneeRepository->findByCriteria($criteria);

            // Renvoyez les résultats de recherche à la vue
            return $this->render('tournee/search_results.html.twig', [
                'results' => $results,
            ]);
        }

        // Affichez le formulaire de recherche
        return $this->render('tournee/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'app_tournee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer): Response
    {
        $tournee = new Tournee();
        $form = $this->createForm(TourneeType::class, $tournee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tournee);
            $entityManager->flush();
            //email 
            $email = (new Email())
            ->from('hamdanidhia4@gmail.com')
            ->to('hamdanidhia4@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>Vous etes affecté à une nouvelle tournée!</p>');

        $mailer->send($email);

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
  

