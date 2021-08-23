<?php

namespace App\Controller;

use App\Entity\Conteneur;

use App\Form\ContainerType;
use App\Form\ConteneurType;
use App\Repository\ChassisRepository;
use App\Repository\ConteneurRepository;

use App\Repository\VrackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Conteneur")
 */
class ContainerController extends AbstractController
{
    /**
     * @Route("/", name="Conteneur_index", methods={"GET"})
     */
    public function index(ConteneurRepository $ConteneurRepository): Response
    {
        return $this->render('Container/index.html.twig', [
            'Conteneurs' => $ConteneurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Conteneur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Conteneur = new Conteneur();
        $form = $this->createForm(ContainerType::class, $Conteneur);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Conteneur);
            $entityManager->flush();

            return $this->redirectToRoute('Conteneur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Container/new.html.twig', [
            'Conteneur' => $Conteneur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Conteneur_show", methods={"GET"})
     */
    public function show(Conteneur $Conteneur): Response
    {
        return $this->render('Container/show.html.twig', [
            'Conteneur' => $Conteneur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Conteneur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Conteneur $Conteneur,ConteneurRepository $ConteneurRepository,ChassisRepository $chassisRepository,VrackRepository $vracRepository): Response
    {
        $session=new Session();
        $reservation_id = $session->get('reservation');
        $form = $this->createForm(ContainerType::class, $Conteneur);
        $form->handleRequest($request);
        $user=$this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            if ($Conteneur->getBlEtat() == false)
            {
                $nb=rand(1000,9999);
                $Conteneur->setBl($nb);

            }
            $Conteneur->setEtat(1);
            $this->getDoctrine()->getManager()->flush();


            $n1=$chassisRepository->createQueryBuilder('u')->select('count(u.id)')->where('u.etat = 0')->andWhere('u.reservation_id = '.intval($reservation_id->getId()).'')->getQuery()->getSingleScalarResult();
            $n2=      $ConteneurRepository->createQueryBuilder('u')->select('count(u.id)')->where('u.etat = 0')->andWhere('u.reservation_id = '.intval($reservation_id->getId()).'')->getQuery()->getSingleScalarResult();
            $n3=    $vracRepository->createQueryBuilder('u')->select('count(u.id)')->where('u.etat = 0')->andWhere('u.reservation_id = '.intval($reservation_id->getId()).'')->getQuery()->getSingleScalarResult();
        if($n1 + $n2 + $n3 == 0)
        {
            return $this->redirectToRoute('finish' , array('user'=>$user));
        }
            return $this->redirectToRoute('choix', array('ch' => $chassisRepository->findAll(), 'co' => $ConteneurRepository->findAll(),'vr' => $vracRepository->findAll(),'user'=>$user
        )) ;
        }

        return $this->render('Container/edit.html.twig', [
            'Conteneur' => $Conteneur,
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/{id}", name="Conteneur_delete", methods={"POST"})
     */
    public function delete(Request $request, Conteneur $Conteneur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Conteneur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Conteneur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Conteneur_index', [], Response::HTTP_SEE_OTHER);
    }
}
