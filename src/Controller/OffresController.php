<?php

namespace App\Controller;

use App\Entity\Commentaires;
use App\Entity\Guest;
use App\Entity\Offres;
use App\Entity\User;
use App\Form\CommentaireGguestType;
use App\Form\CommentairesOffreType;
use App\Form\GuestType;
use App\Form\MailformType;
use App\Form\OffresType;
use App\Form\ResultatOffreType;
use App\Repository\OffresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/")
 */
class OffresController extends AbstractController
{
    /**
     * @Route("/admin/appel_offres", name="offres_index", methods={"GET"})
     */
    public function index(OffresRepository $offresRepository): Response
    {
        return $this->render('back/offres/index.html.twig', [
            'offres' => $offresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/appel_offres/new", name="offres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $offre = new Offres();
        $form = $this->createForm(OffresType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('pdf')->getData()) {
                $file = $form->get('pdf')->getData();

                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

                // moves the file to the directory where pdf are stored
                $file->move(
                    $this->getParameter('offres_pdf_directory'),
                    $fileName
                );

                // updates the 'pdf' property to store the PDF file name
                // instead of its contents
                $offre->setPdf($fileName);

            }

            $offre->setType("Ouvert");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('offres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/offres/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/appel_offres/{id}", name="offres_delete", methods={"POST"})
     */
    public function delete(Request $request, Offres $offre): Response
    {
        if ($this->isCsrfTokenValid('delete' . $offre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offre);
            $entityManager->flush();
        }
        return $this->redirectToRoute('offres_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/admin/appel_offres/show/{id}", name="offres_show", methods={"GET","POST"})
     */
    public function show(Offres $offre, Request $request, $id, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ResultatOffreType::class);
        $form->handleRequest($request);

        $formC = $this->createForm(MailformType::class);
        $formC->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('resultatPdf')->getData();

            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // moves the file to the directory where pdf are stored
            $file->move(
                $this->getParameter('offres_pdf_directory'),
                $fileName
            );

            // updates the 'pdf' property to store the PDF file name
            // instead of its contents
            $offre->setPdfResultat($fileName);
            $offre->setType("Fermé");
            /***** release date of resunlt****/

            $d = new \DateTime('now');
            $offre->setResultRelDate($d);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('offres_show', ["id" => $id], Response::HTTP_SEE_OTHER);
        }

        if ($formC->isSubmitted() && $formC->isValid()) {

            $email = (new Email())
                ->from('gaming2020room@gmail.com')
                ->to($formC->get('email')->getData())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Réponse')
                ->text('Sending emails is fun again!')
                ->html($formC->get('commentaire')->getData());
            $mailer->send($email);

        }

        return $this->render('back/offres/show.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
            'formC' => $formC->createView()
        ]);
    }

    /**
     * @Route("/admin/appel_offres/{id}/edit", name="offres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offres $offre, $id): Response
    {
        $pdfChemin = $offre->getPdf();
        $form = $this->createForm(OffresType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('pdf')->getData()) {
                $file = $form->get('pdf')->getData();

                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

                // moves the file to the directory where pdf are stored
                $file->move(
                    $this->getParameter('offres_pdf_directory'),
                    $fileName
                );

                // updates the 'pdf' property to store the PDF file name
                // instead of its contents
                $offre->setPdf($fileName);

            } else {
                $offre->setPdf($pdfChemin);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/offres/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }



    /*******FRONT********/

    /**
     * @Route("/appel_offres/details/{id}", name="offres_details", methods={"GET","POST"})
     */
    public function offres_details(Offres $offre, OffresRepository $offresRepository, Request $request, $id): Response
    {

        $commentaire = new Commentaires();
        $form = $this->createForm(CommentaireGguestType::class);
        $form->handleRequest($request);

        /***guest**/
        $guest = new Guest();


        if ($form->isSubmitted() && $form->isValid()) {

            $guest->setNom($form->get('Nom')->getData());
            $guest->setPrenom($form->get('prenom')->getData());
            $guest->setEmail($form->get('email')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($guest);
            $entityManager->flush();

            $commentaire->setCommentaire($form->get('commentaire')->getData());
            $commentaire->setOffres($offre);
            $commentaire->setGuest($guest);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();


            return $this->redirectToRoute('offres_details', ["id" => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/offres/details_offre.html.twig', [
            'offre' => $offre,
            'offres' => $offresRepository->recentOffres(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/appel_offres/ferme", name="appel_offres_ferme")
     */
    public function appel_offres_ferme(OffresRepository $offresRepository): Response
    {

        $start_date = date('Y-m-d H:i:s');
        $end_date = date("Y-m-d 23:59:59", strtotime('-10 days', strtotime($start_date)));

        return $this->render('front/appel_offres.html.twig', [
            'offres' => $offresRepository->findBy(["type" => "Ferme"]),
            'tous' => "fe",
            'new' => $end_date
        ]);
    }

    /**
     * @Route("/appel_offres/ouvert", name="appel_offres_ouvert")
     */
    public function appel_offres_ouvert(OffresRepository $offresRepository): Response
    {

        $start_date = date('Y-m-d H:i:s');
        $end_date = date("Y-m-d 23:59:59", strtotime('-10 days', strtotime($start_date)));

        return $this->render('front/appel_offres.html.twig', [
            'offres' => $offresRepository->findBy(["type" => "Ouvert"]),
            'tous' => "ou",
            'new' => $end_date
        ]);
    }

    /**
     * @Route("/appel_offres/userCommentOffre/{id}/{comment}", options={"expose"=true} , name="userCommentOffre", methods={"GET","POST"})
     */
    public function userCommentOffre($id, $comment, Request $request): Response
    {
        $c = urldecode($comment);
        $offreComment = new Commentaires();
        $offreComment->setUser($this->getUser());
        $offreComment->setCommentaire($c);
        $offre = $this->getDoctrine()->getRepository(Offres::class)->find($id);
        $offreComment->setOffres($offre);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($offreComment);
        $entityManager->flush();

        return $this->redirectToRoute('offres_show', ['id' => $id], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/admin/appel_offres/responseToOffreComment/{id}", options={"expose"=true} , name="responseToOffreComment", methods={"GET","POST"})
     */
    public function responseToOffreComment($id, Request $request, MailerInterface $mailer): Response
    {
        $com=$this->getDoctrine()->getRepository(Commentaires::class)->find($request->request->get('comId'));
        $com->setFerme(1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($com);
        $entityManager->flush();
        $email = (new Email())
            ->from('gaming2020room@gmail.com')
            ->to($request->request->get('email'))
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($request->request->get('objet'))
            ->text('Sending emails is fun again!')
            ->html($request->request->get('mailText'));
        $mailer->send($email);

        return $this->redirectToRoute('offres_show', ['id' => $id], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/admin/appel_offres/printOffre/{id}", name="printOffre", methods={"GET","POST"})
     */
    public function printOffre($id)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('back/offres/offreDetails.html.twig', [
            'offre' => $this->getDoctrine()->getRepository(Offres::class)->find($id),
        ]);


        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream($this->getDoctrine()->getRepository(Offres::class)->find($id)->getTitre(), [
            "Attachment" => true
        ]);
    }


}