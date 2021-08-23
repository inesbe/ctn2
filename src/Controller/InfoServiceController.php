<?php

namespace App\Controller;

use App\Entity\InfoService;
use App\Form\InfoServiceType;
use App\Repository\InfoServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class InfoServiceController extends AbstractController
{
    /**
     * @Route("/admin/infoservice", name="info_service_admin", methods={"GET"})
     */
    public function index(InfoServiceRepository $infoServiceRepository): Response
    {
        return $this->render('back/info_service/index.html.twig', [
            'info_services' => $infoServiceRepository->findAll(),
        ]);
    }
    /**
     * @Route("/infoservice", name="info_service_front", methods={"GET"})
     */
    public function indexfront(InfoServiceRepository $infoServiceRepository): Response
    {
        return $this->render('front/services.html.twig', [
            'info_services' => $infoServiceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/infoservice/new", name="info_service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infoService = new InfoService();
        $form = $this->createForm(InfoServiceType::class, $infoService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infoService);
            $entityManager->flush();

            return $this->redirectToRoute('info_service_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/info_service/new.html.twig', [
            'info_service' => $infoService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/infoservice/{id}", name="info_service_show", methods={"GET"})
     */
    public function show(InfoService $infoService): Response
    {
        return $this->render('back/info_service/show.html.twig', [
            'info_service' => $infoService,
        ]);
    }

    /**
     * @Route("/admin/infoservice/{id}/edit", name="info_service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfoService $infoService): Response
    {
        $form = $this->createForm(InfoServiceType::class, $infoService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_service_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/info_service/edit.html.twig', [
            'info_service' => $infoService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/infoservice/{id}", name="info_service_delete", methods={"POST"})
     */
    public function delete(Request $request, InfoService $infoService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infoService->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infoService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('info_service_admin');;
    }
}
