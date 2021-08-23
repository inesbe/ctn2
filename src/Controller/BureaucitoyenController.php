<?php

namespace App\Controller;

use App\Entity\Bureaucitoyen;
use App\Form\BureaucitoyenType;
use App\Repository\BureaucitoyenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bureaucitoyen")
 */
class BureaucitoyenController extends AbstractController
{
    /**
     * @Route("/", name="bureaucitoyen_index", methods={"GET"})
     */
    public function index(BureaucitoyenRepository $bureaucitoyenRepository): Response
    {
        return $this->render('bureaucitoyen/index.html.twig', [
            'bureaucitoyens' => $bureaucitoyenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bureaucitoyen_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bureaucitoyen = new Bureaucitoyen();
        $form = $this->createForm(BureaucitoyenType::class, $bureaucitoyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bureaucitoyen);
            $entityManager->flush();

            return $this->redirectToRoute('bureaucitoyen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bureaucitoyen/new.html.twig', [
            'bureaucitoyen' => $bureaucitoyen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bureaucitoyen_show", methods={"GET"})
     */
    public function show(Request $request,Bureaucitoyen $bureaucitoyen): Response
    {
        $form = $this->createForm(BureaucitoyenType::class, $bureaucitoyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bureaucitoyen);
            $entityManager->flush();

            return $this->redirectToRoute('bureaucitoyen_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bureaucitoyen/show.html.twig', [
            'bureaucitoyen' => $bureaucitoyen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bureaucitoyen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bureaucitoyen $bureaucitoyen): Response
    {
        $form = $this->createForm(BureaucitoyenType::class, $bureaucitoyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bureaucitoyen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bureaucitoyen/edit.html.twig', [
            'bureaucitoyen' => $bureaucitoyen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bureaucitoyen_delete", methods={"POST"})
     */
    public function delete(Request $request, Bureaucitoyen $bureaucitoyen): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bureaucitoyen->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bureaucitoyen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bureaucitoyen_index', [], Response::HTTP_SEE_OTHER);
    }
}
