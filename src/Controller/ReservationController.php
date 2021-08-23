<?php

namespace App\Controller;

use App\Entity\Chassis;
use App\Entity\Conteneur;
use App\Entity\Reservation;
use App\Entity\Vrack;
use App\Form\ChassisType;
use App\Form\ConteneurType;
use App\Form\ReservationType;
use App\Form\VrackType;
use App\Repository\ChassisRepository;
use App\Repository\ConteneurRepository;
use App\Repository\ReservationRepository;
use App\Repository\VrackRepository;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @Route("/")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation_index", methods={"GET"})
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        $user=$this->getUser();
        return $this->render('front/reservation/index.html.twig', [
            'reservations' => $reservationRepository->findBy(['archive' => null,'user'=>$user]),
            'user'=>$user
        ]);
    }

    /**
     * @Route("/reservation/new", name="reservation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservation();
        $conteneur = new Conteneur();
        $vrack = new Vrack();
        $chassis = new Chassis();

        $user=$this->getUser();
        return $this->render('front/reservation/new.html.twig', [
            'reservation' => $reservation,
            'user'=>$user
        ]);
    }

    /**
     * @Route("/reservation/{id}", name="reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        $user=$this->getUser();
        return $this->render('front/reservation/show.html.twig', [
            'reservation' => $reservation,'user'=>$user
        ]);
    }


    /**
     * @Route("/admin/reservation", name="reservation_index_back", methods={"GET"})
     */
    public function indexBack(ReservationRepository $reservationRepository): Response
    {
        return $this->render('back/reservation/index.html.twig', [
            'reservations' => $reservationRepository->findBy(['archive' => null]),
            't' => false,
            'v' => false,
            'c' => false,
            'r' => false,
        ]);
    }

    /**
     * @Route("/admin/reservation/valideesBack", name="valideesBack", methods={"GET"})
     */
    public function valideesBack(ReservationRepository $reservationRepository): Response
    {
        return $this->render('back/reservation/index.html.twig', [
            'reservations' => $reservationRepository->findBy(['valide' => true, 'archive' => null]),
            't' => false,
            'v' => true,
            'c' => false,
            'r' => false,
        ]);
    }

    /**
     * @Route("/admin/reservation/refuseesBack", name="refuseesBack", methods={"GET"})
     */
    public function refuseesBack(ReservationRepository $reservationRepository): Response
    {
        return $this->render('back/reservation/index.html.twig', [
            'reservations' => $reservationRepository->findBy(['valide' => false, 'archive' => null]),
            't' => false,
            'v' => true,
            'c' => false,
            'r' => true,
        ]);
    }

    /**
     * @Route("/admin/reservation/confirmeesBack", name="confirmeesBack", methods={"GET"})
     */
    public function confirmeesBack(ReservationRepository $reservationRepository): Response
    {
        return $this->render('back/reservation/index.html.twig', [
            'reservations' => $reservationRepository->findBy(['confirme' => true, 'archive' => null]),
            't' => false,
            'v' => false,
            'c' => true,
            'r' => false,
        ]);
    }

    /**
     * @Route("/admin/reservation/nonTraiteesBack", name="nonTraiteesBack", methods={"GET"})
     */
    public function nonTraiteesBack(ReservationRepository $reservationRepository): Response
    {
        return $this->render('back/reservation/index.html.twig', [
            'reservations' => $reservationRepository->findBy(['valide' => null, 'confirme' => null, 'archive' => null]),
            't' => true,
            'v' => false,
            'c' => false,
            'r' => false,
        ]);
    }

    /**
     * @Route("/admin/reservation/archivesReservation", name="archivesReservation", methods={"GET"})
     */
    public function archivesReservation(ReservationRepository $reservationRepository): Response
    {
        return $this->render('back/reservation/archives.html.twig', [
            'reservations' => $reservationRepository->findBy(['archive' => 1]),
        ]);
    }


    /**
     * @Route("/admin/reservation/{id}", name="reservation_showBack", methods={"GET","POST"})
     */
    public function showBack(Reservation $reservation, $id, Request $request): Response
    {

        $form = $this->createForm(ReservationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $r = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
            dd($form->get('dateExacte')->getData());
            $r->setDateExacte($form->get('dateExacte')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($r);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_showBack', ["id" => $id], Response::HTTP_SEE_OTHER);
        }


        $formC = $this->createForm(ConteneurType::class);
        $formC->handleRequest($request);

        if ($formC->isSubmitted() && $formC->isValid()) {
            $conteneur = $this->getDoctrine()->getRepository(Conteneur::class)->find($formC->get('id')->getData());
            $conteneur->setType($formC->get('type')->getData());
            $conteneur->setRef($formC->get('ref')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($conteneur);
            $entityManager->flush();


            return $this->redirectToRoute('reservation_showBack', ["id" => $id], Response::HTTP_SEE_OTHER);
        }

        $formCh = $this->createForm(ChassisType::class);
        $formCh->handleRequest($request);

        if ($formCh->isSubmitted() && $formCh->isValid()) {
            $chassis = $this->getDoctrine()->getRepository(Chassis::class)->find($formCh->get('id')->getData());
            $chassis->setType($formCh->get('type')->getData());
            $chassis->setRef($formCh->get('ref')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($chassis);
            $entityManager->flush();


            return $this->redirectToRoute('reservation_showBack', ["id" => $id], Response::HTTP_SEE_OTHER);
        }

        $formV = $this->createForm(VrackType::class);
        $formV->handleRequest($request);

        if ($formV->isSubmitted() && $formV->isValid()) {
            $vrack = $this->getDoctrine()->getRepository(Vrack::class)->find($formV->get('id')->getData());
            $vrack->setCodeEmballage($formV->get('codeEmballage')->getData());
            $vrack->setRef($formV->get('ref')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($vrack);
            $entityManager->flush();


            return $this->redirectToRoute('reservation_showBack', ["id" => $id], Response::HTTP_SEE_OTHER);
        }


        return $this->render('back/reservation/show.html.twig', [
            'reservation' => $reservation,
            'formC' => $formC->createView(),
            'formCh' => $formCh->createView(),
            'formV' => $formV->createView(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/reservation/modDateExact/{id}/{date}", options={"expose"=true} , name="reservation_showBack_modDateExact", methods={"GET","POST"})
     */
    public function modifierDateExact($date, $id, Request $request): Response
    {

        $r = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        $r->setDateExacte(new \DateTime($date));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($r);
        $entityManager->flush();

        return $this->json(['code' => 200,
            'message' => 'date exacte ajouté'],
            200);


    }


    /**
     * @Route("/reservation/{id}/edit", name="reservation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reservation/{id}", name="reservation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/reservation/new/addContainter/{type}", options={"expose"=true} ,name="reservation_new_addContainter")
     */
    public function addContainter($type, Request $request): Response
    {
        $c = new Conteneur();
        $c->setType($type);
$nb= $nb=rand(1000,9999);
$c->setEtat(0);
        $c->setBlEtat(0);
        $c->setNumContainer($nb);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($c);
        $entityManager->flush();

        return $this->json(['code' => 200,
            'id' => $c->getId(),
            'message' => 'conteneur bien ajouté'],
            200);

    }

    /**
     * @Route("/reservation/new/addChassis/{type}", options={"expose"=true} ,name="reservation_new_addChassis")
     */
    public function addChassis($type, Request $request): Response
    {
        $c = new Chassis();
        $c->setType($type);
        $c->setEtat(0);
        $nb=rand(1000,9999);
        $c->setEtatBl(0);
        $c->setMatriculeChassis('Ch'.$nb);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($c);
        $entityManager->flush();

        return $this->json(['code' => 200,
            'id' => $c->getId(),
            'message' => 'Chassis bien ajouté'],
            200);

    }

    /**
     * @Route("/reservation/new/addVrack/{cdEm}", options={"expose"=true} ,name="reservation_new_addVrack")
     */
    public function addVrack($cdEm, Request $request): Response
    {
        $v = new Vrack();
        $v->setCodeEmballage($cdEm);
        $v->setEtat(0);
        $v->setEtatBl(0);
        $nb=rand(1000,9999);
        $v->setMatriculeVrac('Vr'.$nb);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($v);
        $entityManager->flush();

        return $this->json(['code' => 200,
            'id' => $v->getId(),
            'message' => 'Vrack bien ajouté'],
            200);

    }

    /**
     * @Route("/admin/reservation/modContainter/{id}/{idR}",name="reservation_modContainter", methods={"POST"})
     */
    public function modContainter( $idR, $id,Request $request): Response
    {
        $conteneur = $this->getDoctrine()->getRepository(Conteneur::class)->find($id);
        $conteneur->setType($request->request->get('type'));
        $conteneur->setRef($request->request->get('ref'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($conteneur);
        $entityManager->flush();

        return $this->redirectToRoute('reservation_showBack', ["id" => $idR], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/admin/reservation/modChassis/{id}/{idR}",name="reservation_modChassis", methods={"POST"})
     */
    public function modChassis( $idR, $id,Request $request): Response
    {
        $chassis = $this->getDoctrine()->getRepository(Chassis::class)->find($id);
        $chassis->setType($request->request->get('type'));
        $chassis->setRef($request->request->get('ref'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($chassis);
        $entityManager->flush();

        return $this->redirectToRoute('reservation_showBack', ["id" => $idR], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/admin/reservation/new/modVrack/{id}/{idR}",name="reservation_modVrack", methods={"POST"})
     */
    public function modVrack( $idR, $id,Request $request): Response
    {
        $vrack = $this->getDoctrine()->getRepository(Vrack::class)->find($id);
        $vrack->setCodeEmballage($request->request->get('type'));
        $vrack->setRef($request->request->get('ref'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($vrack);
        $entityManager->flush();

        return $this->redirectToRoute('reservation_showBack', ["id" => $idR], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/admin/reservation/deleteContainer/{id}/{idR}" ,name="reservation_back_deletCont")
     */
    public function deletContainer($id, $idR, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $c = $this->getDoctrine()->getRepository(Conteneur::class)->find($id);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($c);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_showBack', ["id" => $idR], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/admin/reservation/deletChassis/{id}/{idR}" ,name="reservation_back_deletChassis")
     */
    public function deletChassis($id, $idR, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $c = $this->getDoctrine()->getRepository(Chassis::class)->find($id);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($c);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_showBack', ["id" => $idR], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/admin/reservation/deletVrack/{id}/{idR}" ,name="reservation_back_deletVrack")
     */
    public function deletVrack($id, $idR, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $v = $this->getDoctrine()->getRepository(Vrack::class)->find($id);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($v);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_showBack', ["id" => $idR], Response::HTTP_SEE_OTHER);

    }


    /**
     * @Route("/reservation/new/addReservation/{dateMin}/{dateMax}/{portArrive}/{lisIdsC}/{lisIdsV}/{lisIdsCh}", options={"expose"=true} ,name="reservation_new_addReservation",methods={"GET","POST"})
     */
    public function addReservation($dateMin, $dateMax, $portArrive, $lisIdsC, $lisIdsV, $lisIdsCh, Request $request, MailerInterface $mailer,ConteneurRepository $conteneurRepository,ChassisRepository $chassisRepository,VrackRepository $vrackRepository): Response
    {
$occ=0;
        $user = $this->getUser();
        $reservationText = "Bonjour, J'amerais reserver vers $portArrive, dans un intervale de temps de $dateMin jusqu'à $dateMax :";
        if ($user) {
            $r = new Reservation();
$bl = rand(1000000,9999999);
$session=new Session();

$session->set('bl',$bl);

            $r->setDateMin(new \DateTime($dateMin));

            $r->setDateMax(new \DateTime($dateMax));
            $r->setPortArrive($portArrive);
            $r->setUser($user);


            $cont = explode("a", $lisIdsC);

            for ($i = 1; $i < sizeof($cont) - 1; $i++) {
                $c = $this->getDoctrine()->getRepository(Conteneur::class)->find($cont[$i]);
                $c->setReservation($r);

                $conteneurRepository->createQueryBuilder('c')->update('App\Entity\Conteneur','c')->set('c.bl',$bl)->where('c.id = '.$c->getId().'')->getQuery()->execute();
                $d = $conteneurRepository->createQueryBuilder('c')->select('c')->where('c.id = '.$c->getId().'')->getQuery()->getResult();

                $session->set('reservation',$d[0]->getReservation   ());

                $c->setUser($user);
                $type = $c->getType();
                $reservationText = $reservationText . " Conteneur de type $type, ";
            }
            $occ=0;

            $chassis = explode("a", $lisIdsCh);
            for ($i = 1; $i < sizeof($chassis) - 1; $i++) {
                $ch = $this->getDoctrine()->getRepository(Chassis::class)->find($chassis[$i]);
                $ch->setReservation($r);
                $chassisRepository->createQueryBuilder('c')->update('App\Entity\Chassis','c')->set('c.bl',$bl)->where('c.id = '.$ch->getId().'')->getQuery()->execute();
                if ($occ == 0) {
                    $d = $chassisRepository->createQueryBuilder('c')->select('c')->where('c.id = '.$ch->getId().'')->getQuery()->getResult();

                    $session->set('reservation',$d[0]->getReservation   ());
                    $occ++;
                }
                $ch->setUser($user);
                $type = $ch->getType();
                $reservationText = $reservationText . " Chassis de type $type, ";
            }

            $vrack = explode("a", $lisIdsV);
            for ($i = 1; $i < sizeof($vrack) - 1; $i++) {
                $v = $this->getDoctrine()->getRepository(Vrack::class)->find($vrack[$i]);
                $v->setReservation($r);
                $vrackRepository->createQueryBuilder('c')->update('App\Entity\Vrack','c')->set('c.bl',$bl)->where('c.id = '.$v->getId().'')->getQuery()->execute();
                $v->setUser($user);
                $d = $vrackRepository->createQueryBuilder('c')->select('c')->where('c.id = '.$v->getId().'')->getQuery()->getResult();

                $session->set('reservation',$d[0]->getReservation());
                $type = $v->getCodeEmballage();
                $reservationText = $reservationText . " Chassis d'emballage $type, ";
            }
            $nom = $user->getNom() . $user->getPrenom();
            $reservationText = $reservationText . "$nom";
            $reservationText1 = $reservationText . "<br>$nom";
            $r->setReservationText($reservationText);

            $email = (new Email())
                ->from('gaming2020room@gmail.com')
                ->to($user->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Réservation')
                ->text('Sending emails is fun again!')
                ->html($reservationText1);
            $mailer->send($email);


            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($r);
            $entityManager->flush();

            return $this->json(['code' => 200,
                'id' => $r->getId(),
                'message' => 'Réservation bien ajouté'],
                200);
        }

        return $this->redirectToRoute('sign_up', [], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/admin/reservation/validerReservation/{id}", options={"expose"=true} ,name="validerReservation",methods={"GET","POST"})
     */
    public function validerReservation($id, Request $request, MailerInterface $mailer): Response
    {

        $user = $this->getUser();
        $mailText = "Votre réservation est validée :";
        if ($user) {
            $r = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
            $r->setValide(1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($r);
            $entityManager->flush();
            $port = $r->getPortArrive();
            $date = $r->getDateExacte()->format('Y-m-d');
            $mailText = "Votre réservation vers $port est validé pour le $date";

            $email = (new Email())
                ->from('gaming2020room@gmail.com')
                ->to($r->getUser()->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Réservation')
                ->text('Sending emails is fun again!')
                ->html($mailText);
            $mailer->send($email);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($r);
            $entityManager->flush();

            return $this->json(['code' => 200,
                'id' => $r->getId(),
                'email' => $r->getUser()->getEmail(),
                'message' => 'Réservation bien ajouté'],
                200);
        }

        return $this->redirectToRoute('sign_up', [], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/admin/reservation/refuserReservation/{id}/{objet}/{mailText}", options={"expose"=true} ,name="refuserReservation",methods={"GET","POST"})
     */
    public function refuserReservation($id, $objet, $mailText, Request $request, MailerInterface $mailer): Response
    {

        $user = $this->getUser();
        if ($user) {
            $r = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
            $r->setValide(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($r);
            $entityManager->flush();

            $email = (new Email())
                ->from('gaming2020room@gmail.com')
                ->to($r->getUser()->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject($objet)
                ->text('Sending emails is fun again!')
                ->html(urldecode($mailText));
            $mailer->send($email);


            return $this->json(['code' => 200,
                'id' => $r->getId(),
                'email' => $r->getUser()->getEmail(),
                'message' => 'Réservation bien refusée'],
                200);
        }

        return $this->redirectToRoute('sign_up', [], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/reservation/new/addReservation/{lisIdsC}/{lisIdsV}/{lisIdsCh}", options={"expose"=true} ,name="reservation_new_resetReservation",methods={"GET","POST"})
     */
    public function resetReservation($lisIdsC, $lisIdsV, $lisIdsCh, Request $request): Response
    {


        $cont = explode("a", $lisIdsC);

        for ($i = 1; $i < sizeof($cont) - 1; $i++) {
            $c = $this->getDoctrine()->getRepository(Conteneur::class)->find($cont[$i]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($c);
            $entityManager->flush();

        }

        $chassis = explode("a", $lisIdsCh);
        for ($i = 1; $i < sizeof($chassis) - 1; $i++) {
            $ch = $this->getDoctrine()->getRepository(Chassis::class)->find($chassis[$i]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ch);
            $entityManager->flush();
        }

        $vrack = explode("a", $lisIdsV);
        for ($i = 1; $i < sizeof($vrack) - 1; $i++) {
            $v = $this->getDoctrine()->getRepository(Vrack::class)->find($vrack[$i]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($v);
            $entityManager->flush();
        }


        return $this->json(['code' => 200,
            'message' => 'Reservation réinitialisée'],
            200);

    }

    /**
     * @Route("/reservation/confirmerReservation/{id}" ,name="confirmerReservation",methods={"GET","POST"})
     */
    public function confirmerReservation($id, Request $request, MailerInterface $mailer): Response
    {

        $user = $this->getUser();
        if ($user) {
            $r = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
            $r->setConfirme(1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($r);
            $entityManager->flush();

            $email = (new Email())
                ->from($user->getEmail())
                ->to('gaming2020room@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject("Confirmation reservation d'Id " . $r->getId())
                ->text('Sending emails is fun again!')
                ->html("Je confirme ma réservations");
            $mailer->send($email);


            return $this->redirectToRoute('reservation_show', ["id" => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('sign_up', [], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/reservation/userRfuseReservation/{id}" ,name="userRfuseReservation",methods={"GET","POST"})
     */
    public function userRfuseReservation($id, Request $request, MailerInterface $mailer): Response
    {

        $user = $this->getUser();
        if ($user) {
            $r = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
            $r->setConfirme(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($r);
            $entityManager->flush();

            $email = (new Email())
                ->from($user->getEmail())
                ->to('gaming2020room@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject("Refu reservation d'Id " . $r->getId())
                ->text('Sending emails is fun again!')
                ->html("Je refuse la réservations");
            $mailer->send($email);


            return $this->redirectToRoute('reservation_show', ["id" => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('sign_up', [], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/admin/reservation/archiverReservation/{id}", options={"expose"=true} , name="reservation_archiverReservation", methods={"GET","POST"})
     */
    public function archiverReservation($id, Request $request): Response
    {

        $r = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        $r->setArchive(1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($r);
        $entityManager->flush();

        return $this->redirectToRoute('reservation_index_back', [], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/admin/reservation/desarchiverReservation/{id}", options={"expose"=true} , name="desarchiverReservation", methods={"GET","POST"})
     */
    public function desarchiverReservation($id, Request $request): Response
    {

        $r = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        $r->setArchive(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($r);
        $entityManager->flush();

        return $this->redirectToRoute('archivesReservation', [], Response::HTTP_SEE_OTHER);


    }


    /**
     * @Route("/admin/reservation/addContainterBack/{params}", options={"expose"=true} ,name="reservation_addContainterBack", methods={"GET","POST"})
     */
    public function addContainterBack($params, Request $request): Response
    {
        $p = explode("-", urldecode($params));
        $r = $this->getDoctrine()->getRepository(Reservation::class)->find($p[0]);
        $c = new Conteneur();
        $c->setType($p[1]);
        $c->setRef($p[2]);
        $c->setUser($r->getUser());
        $c->setReservation($r);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($c);
        $entityManager->flush();

        return $this->json(['code' => 200,
            'id' => $c->getId(),
            'message' => 'conteneur bien ajouté'],
            200);

    }

    /**
     * @Route("/admin/reservation/addChassisBack/{params}", options={"expose"=true} ,name="reservation_addChassisBack")
     */
    public function addChassisBack($params, Request $request): Response
    {

        $p = explode("-", urldecode($params));
        $r = $this->getDoctrine()->getRepository(Reservation::class)->find($p[0]);
        $c = new Chassis();
        $c->setType($p[1]);
        $c->setRef($p[2]);
        $c->setUser($r->getUser());
        $c->setReservation($r);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($c);
        $entityManager->flush();

        return $this->json(['code' => 200,
            'id' => $c->getId(),
            'message' => 'Chassis bien ajouté'],
            200);

    }

    /**
     * @Route("/admin/reservation/addVrackBack/{params}", options={"expose"=true} ,name="reservation_addVrackBack")
     */
    public function addVrackBack($params, Request $request): Response
    {
        $p = explode("-", urldecode($params));

        $r = $this->getDoctrine()->getRepository(Reservation::class)->find($p[0]);
        $v = new Vrack();
        $v->setCodeEmballage($p[1]);
        $v->setRef($p[2]);
        $v->setUser($r->getUser());
        $v->setReservation($r);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($v);
        $entityManager->flush();

        return $this->json(['code' => 200,
            'id' => $v->getId(),
            'message' => 'Vrack bien ajouté'],
            200);

    }

    /**
     * @Route("/reservation/listVrack/{lisIdsC}/{lisIdsCh}/{lisIdsV}", options={"expose"=true} ,name="reservation_listVrack")
     */
    public function listVrack($lisIdsC,$lisIdsCh,$lisIdsV, Request $request): Response
    {
        $cont = explode("a", $lisIdsC);
        $lC=[];

        for ($i = 1; $i < sizeof($cont) - 1; $i++) {
            $c = $this->getDoctrine()->getRepository(Conteneur::class)->find($cont[$i]);
            $lC[$i]=$c->getType();
        }

        $chassis = explode("a", $lisIdsCh);
        $lCh=[];

        for ($i = 1; $i < sizeof($chassis) - 1; $i++) {
            $c = $this->getDoctrine()->getRepository(Chassis::class)->find($chassis[$i]);
            $lCh[$i]=$c->getType();
        }

        $cont = explode("a", $lisIdsV);
        $lV=[];

        for ($i = 1; $i < sizeof($cont) - 1; $i++) {
            $c = $this->getDoctrine()->getRepository(Vrack::class)->find($cont[$i]);
            $lV[$i]=$c->getCodeEmballage();
        }



        return $this->json(['code' => 200,
            'lisIdsC' => $lC,
            'lisIdsCh' => $lCh,
            'lisIdsV' => $lV,
            'message' => 'Vrack bien ajouté'],
            200);

    }

}
