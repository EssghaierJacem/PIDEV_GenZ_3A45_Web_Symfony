<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Vol;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use App\Repository\VolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    #[Route('/', name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }
    
    #[Route('/panierAffichage/', name: 'affichage_panier_front')]
    public function indexFront(SessionInterface $session, VolRepository $volRepository)
    {
        $panier = $session->get("panier", []);

        if (!is_array($panier)) {
            $dataPanier = [];
            $total = 0;
        } else {
            // On "fabrique" les données
            $dataPanier = [];
            $total = 0;

            foreach ($panier as $id => $quantite) {
                $vol = $volRepository->find($id);
                $dataPanier[] = [
                    "vol" => $vol,
                    "quantite" => $quantite
                ];
                $total += $vol->getTarif() * $quantite;
            }
        }

        return $this->render('reservation/Panier.html.twig', compact("dataPanier", "total"));
    }

    #[Route('/deletePanier/',name:'deletepanier')]
    public function deletePanier ( SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->set("panier",[]);
        return $this->redirectToRoute("affichage_panier_front");
    }



    /**
     * @Route ("/add/{id}",name="add")
     * @return void
     */
    public function add(Vol $vol,SessionInterface $session)
    {
        //on récupere le panier actuel
        $panier = $session->get("panier", []);
        
        $id=$vol->getId();
        if(!empty ($panier[$id])) {
            $panier[$id]++;
        }else {
            $panier[$id] = 1;
        }

        dump($panier);
        dump($session->get('panier'));

        // on sauvgarde dans la session
        $session->set("panier",$panier);
        return $this->redirectToRoute("affichage_panier_front");
    }
    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Vol $vol, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $vol->getId();

        if(!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }
        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("affichage_panier_front");
    }

    #[Route('/backIndex', name: 'reservation_index', methods: ['GET'])]
    public function Backindex(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/backindex.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }
    #[Route('/statistics', name: 'reservation_statistics', methods: ['GET'])]
    public function statistics(ReservationRepository $reservationRepository): Response
    {
        // Fetch reservation data for statistics
        $reservations = $reservationRepository->findAll();
        $reservationCounts = [];
          // Initialize an array to store reservation counts for each month
          $reservationCounts = array_fill(0, 12, 0);

        // Count reservations for each month
        foreach ($reservations as $reservation) {
            $monthIndex = intval($reservation->getDateReservation()->format('n')) - 1;
            $reservationCounts[$monthIndex]++;
        }

        // Define month names for the chart labels
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        return $this->render('reservation/statistics.html.twig', [
            'chartData' => $months,
            'reservationCounts' => $reservationCounts,
        ]);
    }

    #[Route('/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            $this->addFlash('success', 'reservation created successfully.');

            return $this->redirectToRoute('app_reservation_index');

           
        }

        return $this->renderForm('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }
    #[Route('/back/{id}', name: 'reservation_show', methods: ['GET'])]
    public function backshow(Reservation $reservation): Response
    {
        return $this->render('reservation/backshow.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/back_edit', name: 'back_edit', methods: ['GET', 'POST'])]
    public function back_edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/backedit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }
    #[Route('/{id}/delete', name: 'reservation_delete', methods: ['POST'])]
    public function deleteBack(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
