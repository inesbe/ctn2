<?php

namespace App\Controller;

use App\Entity\Vrac;
use App\Entity\Vrack;
use App\Form\VracType;
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
 * @Route("/vrac")
 */
class VracController extends AbstractController
{
    /**
     * @Route("/", name="vrac_index", methods={"GET"})
     */
    public function index(VrackRepository $vracRepository): Response
    {
        return $this->render('vrac/index.html.twig', [
            'vracs' => $vracRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vrac_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vrac = new Vrack();
        $form = $this->createForm(VracType::class, $vrac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vrac);
            $entityManager->flush();

            return $this->redirectToRoute('vrac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vrac/new.html.twig', [
            'vrac' => $vrac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vrac_show", methods={"GET"})
     */
    public function show(Vrack $vrac): Response
    {
        return $this->render('vrac/show.html.twig', [
            'vrac' => $vrac,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vrac_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vrack $vrac , ConteneurRepository  $containerRepository,ChassisRepository $chassisRepository,VrackRepository $vracRepository): Response
    {
        $session=new Session();
        $reservation_id = $session->get('reservation');
        $form = $this->createForm(VracType::class, $vrac);
        $form->handleRequest($request);
        $user=$this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($vrac->getEtatBl() == false)
            {
                $nb=rand(1000,9999);
                $vrac->setBl($nb);

            }
            $vrac->setEtat(1);
            $this->getDoctrine()->getManager()->flush();


            $n1=$chassisRepository->createQueryBuilder('u')->select('count(u.id)')->where('u.etat = 0')->andWhere('u.reservation_id = '.intval($reservation_id->getId()).'')->getQuery()->getSingleScalarResult();
            $n2=        $containerRepository->createQueryBuilder('u')->select('count(u.id)')->where('u.etat = 0')->andWhere('u.reservation_id = '.intval($reservation_id->getId()).'')->getQuery()->getSingleScalarResult();
            $n3=    $vracRepository->createQueryBuilder('u')->select('count(u.id)')->where('u.etat = 0')->andWhere('u.reservation_id = '.intval($reservation_id->getId()).'')->getQuery()->getSingleScalarResult();
            if($n1 + $n2 + $n3 == 0)
            {
                return $this->redirectToRoute('finish' , array('user'=>$user));
            }
            return $this->redirectToRoute('choix', array('ch' => $chassisRepository->findAll(), 'co' => $containerRepository->findAll(),'vr' => $vracRepository->findAll(),'user'=>$user
            )) ;
        }

        return $this->render('vrac/edit.html.twig', [
            'vrac' => $vrac,
            'user'=>$user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vrac_delete", methods={"POST"})
     */
    public function delete(Request $request, Vrack $vrac): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vrac->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vrac);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vrac_index', [], Response::HTTP_SEE_OTHER);
    }
}
