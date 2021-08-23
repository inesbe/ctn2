<?php

namespace App\Controller;

use App\Entity\Rotation;
use App\Entity\News;
use App\Form\RotationType;
use App\Repository\RotationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rotation")
 */
class RotationController extends AbstractController
{
    /**
     * @Route("/", name="rotation_index", methods={"GET"})
     */
    public function index(RotationRepository $rotationRepository): Response
    {
        return $this->render('rotation/index.html.twig', [
            'rotations' => $rotationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/lol/new2", name="rotation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rotation = new Rotation();
        $form = $this->createForm(RotationType::class, $rotation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rotation);
            $entityManager->flush();

            return $this->redirectToRoute('rotation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rotation/new.html.twig', [
            'rotation' => $rotation,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="rotation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rotation $rotation): Response
    {
        $form = $this->createForm(RotationType::class, $rotation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rotation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rotation/edit.html.twig', [
            'rotation' => $rotation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rotation_delete", methods={"POST"})
     */
    public function delete(Request $request, Rotation $rotation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rotation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rotation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rotation_index', [], Response::HTTP_SEE_OTHER);
    }
}
