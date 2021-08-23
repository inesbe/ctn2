<?php

namespace App\Controller;

use App\Entity\InfoPratique;
use App\Form\InfoPratiqueType;
use App\Repository\InfoPratiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/info5/pratique")
 */
class InfoPratiqueController extends AbstractController
{
    /**
     * @Route("/", name="info_pratique_index", methods={"GET"})
     */
    public function index(InfoPratiqueRepository $infoPratiqueRepository): Response
    {
        return $this->render('back/info_pratique/index.html.twig', [
            'info_pratiques' => $infoPratiqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="info_pratique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infoPratique = new InfoPratique();
        $form = $this->createForm(InfoPratiqueType::class, $infoPratique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infoPratique);
            $entityManager->flush();

            return $this->redirectToRoute('info_pratique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/info_pratique/new.html.twig', [
            'info_pratiques' => $infoPratique,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/aaaa", name="info")
     */
    public function lol(): Response
    {


        return $this->render('front/info.html.twig', [
            'info' => $this->getDoctrine()->getRepository(InfoPratique::class)->findAll()
        ]);
    }



    /**
     * @Route("/{id}/edit", name="info_pratique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfoPratique $infoPratique): Response
    {
        $form = $this->createForm(InfoPratiqueType::class, $infoPratique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_pratique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/info_pratique/edit.html.twig', [
            'info_pratique' => $infoPratique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_pratique_delete", methods={"POST"})
     */
    public function delete(Request $request, InfoPratique $infoPratique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infoPratique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infoPratique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('info_pratique_index', [], Response::HTTP_SEE_OTHER);
    }
}
