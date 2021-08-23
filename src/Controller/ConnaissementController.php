<?php

namespace App\Controller;

use App\Entity\Chassis;
use App\Entity\Connaissement;
use App\Entity\Container;
use App\Entity\Conteneur;
use App\Entity\Vrac;
use App\Entity\Vrack;
use App\Form\ConnaissementType;
use App\Repository\ChassisRepository;
use App\Repository\ConnaissementRepository;
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
 * @Route("/connaissement")
 */
class ConnaissementController extends AbstractController
{
    /**
     * @Route("/", name="connaissement_index", methods={"GET"})
     */
    public function index(ConnaissementRepository $connaissementRepository): Response
    {
        return $this->render('connaissement/index.html.twig', [
            'connaissements' => $connaissementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="connaissement_new", methods={"GET","POST"})
     */
    public function new(Request $request,ChassisRepository $chassisRepository,ConteneurRepository $containerRepository,VrackRepository $vracRepository): Response
    { $session=new Session();
        $reservation_id = $session->get('reservation');
        $ch=new Chassis();
        $c=new Conteneur();
        $v = new Vrack();

        $user=$this->getUser();
        $ch=$chassisRepository->createQueryBuilder('u')->select('u')->where('u.reservation_id ='.intval($reservation_id->getId()).'')->getQuery()->getResult();
       $c = $containerRepository->createQueryBuilder('u')->select('u')->where('u.reservation_id= '.intval($reservation_id->getId()).'')->getQuery()->getResult();
        $v=$vracRepository->createQueryBuilder('u')->select('u')->where('u.reservation_id='.intval($reservation_id->getId()).'')->getQuery()->getResult();

        $connaissement = new Connaissement();
        $form = $this->createForm(ConnaissementType::class, $connaissement);
        $form->handleRequest($request);

        $bl=$session->get('bl');
        $connaissement->setIdUtilisateur($this->getUser()->getId());
        $connaissement->setIdReservation(intval($reservation_id->getId()));
        $connaissement->setBl($bl);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($connaissement);
            $entityManager->flush();
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


        }

        return $this->render('connaissement/new.html.twig', [
            'connaissement' => $connaissement,
            'ch' => $ch,
            'co' => $c,
            'resv' => $reservation_id->getId(),
            'vr' => $v,
            'user'=>$user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="connaissement_show", methods={"GET"})
     */
    public function show(Connaissement $connaissement): Response
    {
        return $this->render('connaissement/show.html.twig', [
            'connaissement' => $connaissement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="connaissement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Connaissement $connaissement): Response
    {
        $form = $this->createForm(ConnaissementType::class, $connaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('connaissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('connaissement/edit.html.twig', [
            'connaissement' => $connaissement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="connaissement_delete", methods={"POST"})
     */
    public function delete(Request $request, Connaissement $connaissement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$connaissement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($connaissement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('connaissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
