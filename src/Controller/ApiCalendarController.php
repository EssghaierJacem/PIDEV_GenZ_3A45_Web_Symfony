<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiCalendarController extends AbstractController
{
    #[Route('/api/calendar', name: 'app_api_calendar')]
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();

        return $this->render('event/calendar.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/api/calendarOnClick/{id}', name: 'calendar_onClick', methods: ['GET'])]
    public function onClick(Event $event, Request $request): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }
}
