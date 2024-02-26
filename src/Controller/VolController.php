<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\VolType;
use App\Repository\VolRepository;
use App\Repository\DestinationRepository;
use App\Repository\UserRepository;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VolController extends AbstractController
{
    #[Route('/vols', name: 'backapp_vol')]
    public function index(VolRepository $volRepository, Request $request,PaginatorInterface $paginator): Response
    {
        $criteria = $request->query->get('criteria', 'ID');
        $pagination = $paginator->paginate(
            $volRepository->findAllSortedByCriteria($criteria),
            $request->query->get('page',1),
            8
        );

        return $this->render('vol/index.html.twig', [
            'pagination' => $pagination,
            'criteria' => $criteria
        ]);
    }

    #[Route('/dest_vol', name: 'dashboard_vol')]
    public function dashboardVol(VolRepository $volRepository, userRepository $userRepository,avisRepository $avisRepository,destinationRepository $destinationRepository): Response
    {
        $vols = $volRepository->findAll();
        $userCount = $userRepository->count([]);
        $volCount = $volRepository->count([]);
        $avisCount = $avisRepository->count([]);
        $destinations = $destinationRepository->findAll();


        return $this->render('vol/volDashboard.html.twig', [
            'vols' => $vols,
            'userCount' => $userCount,
            'volCount' => $volCount,
            'avisCount' => $avisCount,
            'destinations' => $destinations,
        ]);
    }

    #[Route('/show_vol', name: 'app_vol')]
    public function indexVol(VolRepository $volRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $dateDepart = $request->query->get('date_depart');
        $dateArrivee = $request->query->get('date_arrivee');


        if ($dateDepart && $dateArrivee) {
            $vols = $volRepository->findByDateInterval($dateDepart, $dateArrivee);
        } else {
            $vols = $volRepository->findAll();
        }

        $pagination = $paginator->paginate(
            $vols,
            $request->query->get('page', 1),
            5
        );

        return $this->render('vol/frontVol.html.twig', [
            'pagination' => $pagination
        ]);
    }

    #[Route('/vol/new', name: 'app_vol_new')]
    public function new(Request $request, EntityManagerInterface $entityManager,VolRepository $volRepository): Response
    {
        $vol = new Vol();
        $vols = $volRepository->findAll();
        $form = $this->createForm(VolType::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vol);
            $entityManager->flush();

            return $this->redirectToRoute('backapp_vol');
        }

        return $this->render('vol/new.html.twig', [
            'form' => $form->createView(),
            'vols' => $vols,
        ]);
    }

    #[Route('/vol/edit/{id}', name: 'app_vol_edit')]
    public function edit(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $vol = $entityManager->getRepository(Vol::class)->find($id);

        if (!$vol) {
            throw $this->createNotFoundException('Vol not found');
        }

        $form = $this->createForm(VolType::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('backapp_vol');
        }

        return $this->render('vol/edit.html.twig', [
            'form' => $form->createView(),
            'vol' => $vol,
        ]);
    }


    #[Route('/vol/show/{id}', name: 'app_vol_show')]
    public function show(Request $request, $id, EntityManagerInterface $entityManager, VolRepository $volRepository, DestinationRepository $destinationRepository): Response
    {
        $vol = $volRepository->find($id);
        $destinations = $destinationRepository->findAll();

        if (!$vol) {
            throw $this->createNotFoundException('Vol not found');
        }

        return $this->render('vol/show.html.twig', [
            'vol' => $vol,
            'destination' => $destinations,
        ]);
    }

    #[Route('/vol/details/{id}', name: 'app_vol_details_show')]
    public function voldetails($id, VolRepository $volRepository, destinationRepository $destinationRepository): Response
    {
        $vol = $volRepository->find($id);
        $destination = $destinationRepository->find($id);

        if (!$vol) {
            throw $this->createNotFoundException('Vol not found');
        }

        return $this->render('vol/VolDetails.html.twig', [
            'vol' => $vol,
            'destination' =>$destination,
        ]);
    }


    #[Route('/vol/delete/{id}', name: 'app_vol_delete')]
    public function delete(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $vol = $entityManager->getRepository(Vol::class)->find($id);

        if (!$vol) {
            throw $this->createNotFoundException('Vol not found');
        }
        $entityManager->remove($vol);
        $entityManager->flush();
        return $this->redirectToRoute('backapp_vol');
    }
}
