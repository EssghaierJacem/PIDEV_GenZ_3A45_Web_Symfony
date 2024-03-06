<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Form\EventSearchType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event_index')]
    public function index(EventRepository $eventRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $criteria = $request->query->get('criteria', 'ID');
        $pagination = $paginator->paginate(
            $eventRepository->findAllSortedByCriteria($criteria),
            $request->query->get('page', 1),
            8
        );

        return $this->render('event/index.html.twig', [
            'pagination' => $pagination,
            'criteria' => $criteria,
            'events' => $pagination->getItems(), // Passing events to the template
        ]);
    }

    #[Route('/show_event', name: 'app_event')]
    public function events(EventRepository $eventRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $keyword = $request->query->get('keyword');

        $e_event = $eventRepository->findDistinctEvents();

        if ($keyword) {
            $event = $eventRepository->searchByKeyword($keyword);
        } else {
            $event = $eventRepository->paginatonQuery();
        }

        $pagination = $paginator->paginate(
            $event,
            $request->query->get('page', 1),
            6
        );

        return $this->render('event/frontindex.html.twig', [
            'pagination' => $pagination,
            'events' => $e_event,
        ]);
    }

    #[Route('/front_index', name: 'front_event_index', methods: ['GET'])]
    public function Frontindex(EventRepository $eventRepository): Response
    {
        return $this->render('/event/frontindex.html.twig', [
            'events' => $eventRepository->findAll(), // Passing events to the template
        ]);
    }

    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/new.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/front/{id}', name: 'front_event_show', methods: ['GET'])]
    public function showFront(Event $event): Response
    {
        return $this->render('event/Frontshow.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/generate-pdf', name: 'PDFGenerate', methods: ['GET'])]
    public function PDFGenerate(Event $event): Response
    {
        // Logic to generate PDF based on the $event entity
        $html = $this->renderView('event/pdf_template.html.twig', [
            'event' => $event,
        ]);

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($html);

        // (Optional) Setup paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return new Response($dompdf->stream("event_{$event->getId()}.pdf", [
            "Attachment" => true
        ]));
    }
}
