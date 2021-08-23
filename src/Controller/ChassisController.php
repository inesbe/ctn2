<?php

namespace App\Controller;

use App\Entity\Chassis;
use App\Form\ChassisType;
use App\Form\ChassisType2;
use App\Repository\ChassisRepository;
use App\Repository\ContainerRepository;
use App\Repository\ConteneurRepository;
use App\Repository\VrackRepository;
use App\Repository\VracRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chassis")
 */
class ChassisController extends AbstractController
{
    /**
     * @Route("/", name="chassis_index", methods={"GET"})
     */
    public function index(ChassisRepository $chassisRepository): Response
    {
        return $this->render('chassis/index.html.twig', [
            'chassis' => $chassisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chassis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chassis = new Chassis();
        $form = $this->createForm(ChassisType2::class, $chassis);
        $form->handleRequest($request);

$chassis->setNbUnite(3);
$chassis->setUnitePayante($chassis->getNbColis()*$chassis->getPoidsUnitaire());
$chassis->setPoidsBrute($chassis->getUnitePayante()+$chassis->getTare());
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chassis);
            $entityManager->flush();

            return $this->redirectToRoute('chassis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chassis/new.html.twig', [
            'chassis' => $chassis,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chassis_show", methods={"GET"})
     */
    public function show(Chassis $chassis,ChassisRepository $chassisRepository): Response
    {
        return $this->render('chassis/show.html.twig', [
            'chassis' => $chassis,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chassis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chassis $chassis,ConteneurRepository  $containerRepository,ChassisRepository $chassisRepository,VrackRepository $vracRepository): Response
    {
        $form = $this->createForm(ChassisType2::class, $chassis);
        $form->handleRequest($request);
        $session=new Session();
        $reservation_id = $session->get('reservation');
        $user=$this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            if ($chassis->getEtatBl() == false)
            {
            $nb=rand(1000,9999);
            $chassis->setBl($nb);

            }
            $chassis->setEtat(1);
            $this->getDoctrine()->getManager()->flush();

            $n1=$chassisRepository->createQueryBuilder('u')->select('count(u.id)')->where('u.etat = 0')->andWhere('u.reservation_id = '.intval($reservation_id->getId()).'')->getQuery()->getSingleScalarResult();
            $n2=        $containerRepository->createQueryBuilder('u')->select('count(u.id)')->where('u.etat = 0')->andWhere('u.reservation_id = '.intval($reservation_id->getId()).'')->getQuery()->getSingleScalarResult();
            $n3=    $vracRepository->createQueryBuilder('u')->select('count(u.id)')->where('u.etat = 0')->andWhere('u.reservation_id = '.intval($reservation_id->getId()).'')->getQuery()->getSingleScalarResult();
            if($n1 + $n2 + $n3 == 0)
            {
                return $this->redirectToRoute('finish',array('user' => $user));
            }

            return $this->redirectToRoute('choix', array('ch' => $chassisRepository->findAll(), 'co' => $containerRepository->findAll(),'vr' => $vracRepository->findAll()
            ,'user' => $user)) ;
        }

        return $this->render('chassis/edit.html.twig', [
            'chassis' => $chassis,'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chassis_delete", methods={"POST"})
     */
    public function delete(Request $request, Chassis $chassis): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chassis->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chassis);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chassis_index', [], Response::HTTP_SEE_OTHER);
    }
}
