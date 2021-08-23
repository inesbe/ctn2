<?php
namespace App\Controller;


use App\Entity\Conteneur;
use App\Entity\Quota;
use App\Entity\Reclamation;
use App\Entity\Users;
use App\Form\QuotaType;
use App\Form\ReclamationType;
use App\Repository\ChassisRepository;
use App\Repository\ConteneurRepository;
use App\Repository\DocumentsRepository;
use App\Repository\InfoServiceRepository;
use App\Repository\MediasRepository;
use App\Repository\OffresRepository;
use App\Entity\Ligne;
use App\Entity\News;
use App\Entity\Rotation;
use App\Repository\LigneRepository;
use App\Repository\RotationRepository;
use App\Repository\VrackRepository;
use phpDocumentor\Reflection\Type;
use App\Entity\Bureaucitoyen;
use App\Form\BureaucitoyenType;

use App\Repository\BureauRelationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConditionUtilisationRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $n= $this->getDoctrine()->getRepository(News::class)->findAll();

        $user=$this->getUser();
        return $this->render('front/index.html.twig', [
            'news' => $n,
            'user' => $user,
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/historique", name="historique")
     */
    public function historique(): Response
    {
        $user=$this->getUser();
        return $this->render('front/historique.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation(): Response
    {
        $user=$this->getUser();
        return $this->render('front/presentation.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/bonne_gouvernance", name="bonnegouv")
     */
    public function bonne_gouvernance(): Response
    {
        $user=$this->getUser();
        return $this->render('front/bonne_gouvernance.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/acces_relation", name="acces_relation")
     */
    public function acces_relation(): Response
    {
        $user=$this->getUser();
        return $this->render('front/acces_relation.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }






    /**
     * @Route("/bureau_relation_citoyen", name="bureau")
     */

    public function bureau_relation_citoyen(Request $request,MailerInterface $mailer): Response
    { $user=$this->getUser();
        $bureaucitoyen = new Bureaucitoyen();
        $form = $this->createForm(BureaucitoyenType::class, $bureaucitoyen);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bureaucitoyen);
            $entityManager->flush();
            $this->addFlash(
                'info', 'Message envoyé avec succés'
            );

            $email = (new TemplatedEmail())
                ->htmlTemplate('front/contenumail.html.twig'
                )
                ->context(['bureaucitoyen' => $bureaucitoyen])
                ->from('gaming2020room@gmail.com')
                //->to($m->getEmail())
                ->to('ines.benamor@esprit.tn')
                ->subject('[Ctn-Bureau des relations avec le citoyen] Nouveau message  !');
            //->text('Sending emails is fun again!')
            $mailer->send($email);



            return $this->redirectToRoute('bureau',array('user'=>$user));

        }
        return $this->render('front/bureau_relation_citoyen.html.twig', [

            'controller_name' => 'HomeController',
            'bureaucitoyen' => $bureaucitoyen,  'user' => $user,

            'form' => $form->createView(),
        ]);

    }






    /**
     * @Route("/flotte_tanit", name="flottetanit")
     */
    public function flotte_tanit(): Response
    { $user=$this->getUser();
        return $this->render('front/flotte_tanit.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }
    /**
     * @Route("/flotte_carthage", name="flottecarthage")
     */
    public function flotte_carthage(): Response
    { $user=$this->getUser();
        return $this->render('front/flotte_carthage.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/condition_utilisation", name="conditionutilisation")
     */
    public function condition_utilisation(ConditionUtilisationRepository $conditionUtilisation): Response


    { $user=$this->getUser();
        $c=$conditionUtilisation->createQueryBuilder('u')->select('u')->getQuery()->getSingleResult();

        $docObj = new DocxConversion();
        $doc=$docObj->read_docx($c->getFichier());

        return $this->render('front/condition_utilisation.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,

            'word' =>$doc,
            'ConditionUtilisation'=>$c
        ]);
    }

    /**
     * @Route("/reclamation_passagers", name="reclamation_passagers", methods={"GET","POST"})
     */
    public function reclamation_passagers(Request $request): Response
    {
        $user=$this->getUser();
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setType('Passager');
            $currentDate = new \DateTime();
            $currentDate->sub(new \DateInterval('PT1H'));
            $reclamation->setDate($currentDate);
            $reclamation->setEtat(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            $this->addFlash(
                'info',
                'Message envoyé avec succès'
            );

            return $this->redirectToRoute('reclamation_passagers',array('user'=>$user), Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/reclamation_passagers.html.twig', [
            'reclamation' => $reclamation,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reclamation_marchandise", name="reclamation_marchandise", methods={"GET","POST"})
     */
    public function reclamation_marchandises(Request $request): Response
    {
        $user=$this->getUser();
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setType('Marchandise');
            $currentDate = new \DateTime();
            $currentDate->sub(new \DateInterval('PT1H'));
            $reclamation->setDate($currentDate);
            $reclamation->setEtat(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();


            $this->addFlash(
                'info',
                'Message envoyé avec succès'
            );

            return $this->redirectToRoute('reclamation_marchandise', array('user'=>$user), Response::HTTP_SEE_OTHER);

        }

        return $this->render('front/reclamation_marchandise.html.twig', [
            'reclamation' => $reclamation,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/infoservice", name="info_service_front", methods={"GET"})
     */
    public function indexfront(InfoServiceRepository $infoServiceRepository): Response
    {
        $user=$this->getUser();
        return $this->render('front/services.html.twig', [
            'info_services' => $infoServiceRepository->findAll() , 'user' => $user,
        ]);
    }


    /**
     * @Route("/mediatheque", name="mediatheque")
     */
    public function mediatheque(MediasRepository $mediasRepository): Response

    { $user=$this->getUser();
        return $this->render('front/mediatheque.html.twig', [
            'medias' => $mediasRepository->findAll(),
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/bulletin_interne", name="bulletin_interne")
     */
    public function bulletin_interne(): Response
    { $user=$this->getUser();
        return $this->render('front/bulletin_interne.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/document_online", name="document_online")
     */
    public function document_online(DocumentsRepository $documentsRepository,Request $request): Response

    { $user=$this->getUser();

        $quotum = new Quota();
        $form = $this->createForm(QuotaType::class, $quotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quotum);
            $entityManager->flush();

            return $this->redirectToRoute('document_online', array('user' => $user), Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/document_online.html.twig', [
            'documents' => $documentsRepository->findAll(),
            'quotum' => $quotum,
            'form' => $form->createView(),
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/appel_offres", name="appel_offres")
     */
    public function appel_offres(OffresRepository $offresRepository): Response
    {
        $user=$this->getUser();
        $start_date = date('Y-m-d H:i:s');
        $end_date = date("Y-m-d 23:59:59", strtotime('-10 days', strtotime($start_date)));

        return $this->render('front/appel_offres.html.twig', [
            'offres' => $offresRepository->findAll(),
            'tous'=>"yes",  'user' => $user,
            'new'=>$end_date
        ]);
    }
    /**

    /**
     * @Route("/sign_up", name="sign_up")
     */
    public function sign_up(): Response
    {
        $user=$this->getUser();
        return $this->render('front/sign_up.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    { $user=$this->getUser();
        return $this->render('front/contact.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }






    /**
     * @Route("/carthage", name="carthage")
     */
    public function carthage(): Response
    { $user=$this->getUser();
        return $this->render('front/carthage.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/assurance_voyage", name="assurance_voyage")
     */
    public function assurance_voyage(): Response
    { $user=$this->getUser();
        return $this->render('front/assurance_voyage.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }


    /**
     * @Route("/equipements", name="equipements")
     */
    public function equipements(): Response
    { $user=$this->getUser();
        return $this->render('front/equipement.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/restauration_carthage", name="restauration_carthage")
     */
    public function restauration_carthage(): Response
    { $user=$this->getUser();
        return $this->render('front/restauration_carthage.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/cafe_carthage", name="cafe_carthage")
     */
    public function cafe_carthage(): Response
    { $user=$this->getUser();
        return $this->render('front/cafe_carthage.html.twig', [

            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }


    /**
     * @Route("/recuperation_mpd", name="recuperation_mdp")
     */
    public function recuperation_mdp(): Response
    { $user=$this->getUser();
        return $this->render('front/recuperation_mdp.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }
    /**
     * @Route("/code", name="code")
     */
    public function code(): Response
    { $user=$this->getUser();
        return $this->render('front/code.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }
    /**
     * @Route("/nouveau_mdp", name="nouveau_mdp")
     */
    public function nouveau_mdp(): Response
    { $user=$this->getUser();
        return $this->render('front/nouveau_mdp.html.twig', [

            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }
    /**

     * @Route("/assurance_voyage_tanit", name="assurance_voyage_tanit")
     */
    public function assurance_voyage_tanit(): Response
    { $user=$this->getUser();
        return $this->render('front/assurance_voyage_tanit.html.twig', [


            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }




     /**

      * @Route("/map", name="map")
      */
    public function map(): Response
    { $user=$this->getUser();
        return $this->render('front/map.html.twig', [

            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }
    /**

     * @Route("/tanit", name="tanit")
     */
    public function tanit(): Response
    { $user=$this->getUser();
        return $this->render('front/tanit.html.twig', [

            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

     
    /**

     * @Route("/booking", name="booking")
     */
    public function booking(): Response
    { $user=$this->getUser();
        return $this->render('front/booking.html.twig', [

            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }
    /**

     * @Route("/equipements_tanit", name="equipements_tanit")
     */
    public function equipements_tanit(): Response
    { $user=$this->getUser();
        return $this->render('front/equipements_tanit.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }

    /**
     * @Route("/restauration_tanit", name="restauration_tanit")
     */
    public function restauration_tanit(): Response
    { $user=$this->getUser();
        return $this->render('front/restauration_tanit.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }
    /**
     * @Route("/cafe_tanit", name="cafe_tanit")
     */
    public function cafe_tanit(): Response
    { $user=$this->getUser();
        return $this->render('front/cafe_tanit.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }
    /**
     * @Route("/reservation_tanit", name="reservation_tanit")
     */
    public function reservation_tanit(): Response
    { $user=$this->getUser();
        return $this->render('front/reservation_tanit.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }


    /**
     * @Route("/reservation_carthage", name="reservation_carthage")
     */
    public function reservation_carthage(): Response
    { $user=$this->getUser();
        return $this->render('front/reservation_carthage.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
        ]);
    }


    /**
     * @Route("/ERROR404", name="error404", methods={"GET"})
     */
    public function error404(): Response
    {
        return $this->render('front/404.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

      /**

       * @Route("/rotation/{id}", name="rotation")
       */
    public function rotation(News $n , RotationRepository $rotationRepository): Response
    { $user=$this->getUser();
        $l = $this->getDoctrine()->getRepository(Ligne::class)->findAll();
        $r = $rotationRepository->createQueryBuilder('r')->select('r')->where('r.type = 0 ')->getQuery()->getResult();
        $r1 = $rotationRepository->createQueryBuilder('r')->select('r')->where('r.type = 1 ')->getQuery()->getResult();
        $docObj = new DocxConversion();
        $doc=$docObj->read_docx($n->getDocument());
        if ($n->getType() == 0 ) {
            return $this->render('front/rotation.html.twig', [
                'new' => $n,
                'Lines' => $l,
                'Rotations' => $r,
                'Rotations2' => $r1,
                'word' => $doc,  'user' => $user,

            ]);
        }
        else if ($n -> getType() == 1)
        {
            return $this->render('front/type_one.html.twig', [
                'new' => $n,
                'word' => $doc,  'user' => $user,s
            ]);

        }
        else
        {
            return $this->render('front/appel_offres.html.twig', [  'user' => $user,
                'new' => $n ]);
        }

    }

    /**

     * @Route("/profil", name="profil")
     */
    public function profil(): Response
    { $user=$this->getUser();
        $user = new Users();

     $user=$this->getUser();
        return $this->render('front/profil.html.twig', [

            'user' => $user
        ]);
    }



    /**
     * @Route("/chassis", name="chassis")
     */
    public function chassis(): Response
    { $user=$this->getUser();
        $t=$_GET['type'];
        return $this->render('front/chassis.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
            't' => $t
        ]);
    }
    /**
     * @Route("/choix", name="choix")
     */
    public function choix(ChassisRepository $chassisRepository,ConteneurRepository $containerRepository,VrackRepository  $vracRepository): Response
    {
        $session=new Session();
        $reservation_id = $session->get('reservation');

        $ch=$chassisRepository->createQueryBuilder('u')->select('u')->where('u.reservation_id = '.intval($reservation_id->getId()).'')->andWhere('u.etat = 0')->getQuery()->getResult();
        $c = $containerRepository->createQueryBuilder('u')->select('u')->where('u.reservation_id = '.intval($reservation_id->getId()).'')->andWhere('u.etat = 0')->getQuery()->getResult();
        $v=$vracRepository->createQueryBuilder('u')->select('u')->where('u.reservation_id = '.intval($reservation_id->getId()).'')->andWhere('u.etat = 0')->getQuery()->getResult();


        $user=$this->getUser();

        return $this->render('front/choix.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
            'ch' => $ch,
            'co' => $c,
            'vr' =>$v
        ]);
    }
    /**
     * @Route("/choix2", name="choix2")
     */
    public function choix2(ChassisRepository $chassisRepository,Request $request,ConteneurRepository $containerRepository,VrackRepository $vracRepository): Response
    {$ch=$chassisRepository->findAll();
        $c=$containerRepository->findAll();
        $vr=$vracRepository->findAll();
        $user=$this->getUser();
        $t=$request->get('type');
        $t1=substr($t,1);
        $t2=substr($t,0,1);


        if ($t2 == 0) {
            $qb = $chassisRepository->createQueryBuilder('u');
            $id= $qb->select('u.id')->where(
                $qb->expr()->like('u.matricule_chassis', ':user')
            )
                ->setParameter('user','%'.$t1.'%')
                ->getQuery()
                ->getSingleScalarResult();
            return $this->redirectToRoute('chassis_edit', array('t' => $t1, 'id' => $id));
        }
        if ($t2 == 1) {
            $qb = $containerRepository->createQueryBuilder('u');
            $id= $qb->select('u.id')->where(
                $qb->expr()->like('u.num_container', ':user')
            )
                ->setParameter('user','%'.$t1.'%')
                ->getQuery()
                ->getSingleScalarResult();
            return $this->redirectToRoute('Conteneur_edit', array('t' => $t1, 'id' => $id));
        }
        if ($t2 == 2) {
            $qb = $vracRepository->createQueryBuilder('u');
            $id= $qb->select('u.id')->where(
                $qb->expr()->like('u.matricule_vrac', ':user')
            )
                ->setParameter('user','%'.$t1.'%')
                ->getQuery()
                ->getSingleScalarResult();
            return $this->redirectToRoute('vrac_edit', array('t' => $t1, 'id' => $id));
        }



        return $this->render('front/choix.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,
            'ch' => $ch
            ,'co'=>$c,'vr'=>$vr
        ]);
    }

    /**
     * @Route("/finish", name="finish")
     */
    public function end(): Response
    { $user=$this->getUser();


        return $this->render('front/finish.html.twig', [
            'controller_name' => 'HomeController',  'user' => $user,

        ]);
    }










}