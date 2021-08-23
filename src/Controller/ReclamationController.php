<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationReponseType;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
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

    /**
     * @Route("/rec/{id}", name="reclamation_afficher", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        $reclamation->setReponse(null);
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{id}/repondreP", name="reclamation_reponseP", methods={"GET","POST"})
     */
    public function repondre_rec_passager(Request $request, Reclamation $reclamation,\Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ReclamationReponseType::class, $reclamation);
        $form->handleRequest($request);

        if($reclamation->getEtat()==0){

            if ($form->isSubmitted() && $form->isValid()) {
                if( $reclamation->getType()== "Passager") {

                    $reclamation->setEtat(1);
                    $currentDate = new \DateTime();
                    $currentDate->sub(new \DateInterval('PT1H'));
                    $reclamation->setDateReponse($currentDate);


                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($reclamation);
                    $entityManager->flush();

                    $message = (new \Swift_Message('Réponse à une réclamation client'))
                        ->setFrom('Gaming2020Room@gmail.com')
                        ->setTo($reclamation->getEmail())
                        ->setBody($this->renderView(
                            'reclamation/EmailReclamation/reponseReclamation.html.twig', ['reclamation' => $reclamation,]
                        ),
                            'text/html');
                    $mailer->send($message);


                    $this->addFlash(
                        'info',
                        'Email envoyé avec succès'
                    );

                    return $this->redirectToRoute('index_passagers', [], Response::HTTP_SEE_OTHER);
                }

            }

            return $this->render('reclamation/reponse.html.twig', [
                'reclamation' => $reclamation,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('backERROR404', [], Response::HTTP_SEE_OTHER);
        }

    }

    /**
     * @Route("/{id}/repondreM", name="reclamation_reponseM", methods={"GET","POST"})
     */
    public function repondre_rec_marchandise(Request $request, Reclamation $reclamation,\Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ReclamationReponseType::class, $reclamation);
        $form->handleRequest($request);


        if($reclamation->getEtat()==0){


            if ($form->isSubmitted() && $form->isValid()) {

                if( $reclamation->getType()== "Marchandise") {


                    $reclamation->setEtat(1);
                    $currentDate = new \DateTime();
                    $currentDate->sub(new \DateInterval('PT1H'));
                    $reclamation->setDateReponse($currentDate);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($reclamation);
                    $entityManager->flush();


                    $message = (new \Swift_Message('Réponse à une réclamation client'))
                        ->setFrom('Gaming2020Room@gmail.com')
                        ->setTo($reclamation->getEmail())
                        ->setBody($this->renderView(
                            'reclamation/EmailReclamation/reponseReclamation.html.twig', ['reclamation' => $reclamation,]
                        ),
                            'text/html');
                    $mailer->send($message);


                    $this->addFlash(
                        'info',
                        'Email envoyé avec succès'
                    );

                    return $this->redirectToRoute('index_marchandise', [], Response::HTTP_SEE_OTHER);
                }

            }

            return $this->render('reclamation/reponse.html.twig', [
                'reclamation' => $reclamation,
                'form' => $form->createView(),
            ]);

        } else {
            return $this->redirectToRoute('backERROR404', [], Response::HTTP_SEE_OTHER);
        }

    }

    /**
     * @Route("/supprimerM/{id}", name="reclamation_supprimerM", methods={"POST"})
     */
    public function deleteM(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index_marchandise', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/supprimerP/{id}", name="reclamation_supprimP", methods={"POST"})
     */
    public function deleteP(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index_passagers', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/afficherrep/{id}", name="reponse_afficher", methods={"GET"})
     */
    public function afficher_reponse(Reclamation $reclamation): Response
    {
        if($reclamation->getEtat()==1 && $reclamation->getReponse() != null){
            return $this->render('reclamation/afficherReponse.html.twig', [
                'reclamation' => $reclamation,
            ]);
        }else{
            return $this->redirectToRoute('backERROR404', [], Response::HTTP_SEE_OTHER);
        }
    }
}

