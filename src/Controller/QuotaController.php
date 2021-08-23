<?php

namespace App\Controller;

use App\Entity\Quota;
use App\Form\QuotaType;
use App\Repository\QuotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quota")
 */
class QuotaController extends AbstractController
{
    /**
     * @Route("/quota", name="quota_index", methods={"GET"})
     */
    public function index(QuotaRepository $quotaRepository): Response
    {
        return $this->render('front/quota/index.html.twig', [
            'quotas' => $quotaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/quota/new", name="quota_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quotum = new Quota();
        $form = $this->createForm(QuotaType::class, $quotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quotum);
            $entityManager->flush();

            return $this->redirectToRoute('documents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/quota/new.html.twig', [
            'quotum' => $quotum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/quota/{id}", name="quota_show", methods={"GET"})
     */
    public function show(Quota $quotum): Response
    {
        return $this->render('front/quota/show.html.twig', [
            'quotum' => $quotum,
        ]);
    }

    /**
     * @Route("/quota/{id}/edit", name="quota_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quota $quotum): Response
    {
        $form = $this->createForm(QuotaType::class, $quotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/quota/edit.html.twig', [
            'quotum' => $quotum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/quota/{id}", name="quota_delete", methods={"POST"})
     */
    public function delete(Request $request, Quota $quotum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quotum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quotum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quota_index', [], Response::HTTP_SEE_OTHER);
    }
}
