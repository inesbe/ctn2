<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ReclamationController extends AbstractController
{
    /**
     * @Route("/admin/reclamation/reclamationM", name="index_marchandise", methods={"GET"})
     */
    public function index_marchandise(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index_marchandise.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/reclamation/reclamationP", name="index_passagers", methods={"GET"})
     */
    public function index_passager(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index_passagers.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/reclamation_passagers", name="reclamation_passagers", methods={"GET","POST"})
     */
    public function reclamation_passagers(Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setType('Passager');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/reclamation_passagers.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reclamation_marchandise", name="reclamation_marchandise", methods={"GET","POST"})
     */
    public function reclamation_marchandise(Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setType('Marchandise');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/reclamation_marchandise.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="reclamation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }
}

