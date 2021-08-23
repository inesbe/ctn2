<?php

namespace App\Controller;

use App\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/home", name="admin")
     */
    public function index(): Response
    {
        return $this->render('back/index1.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/bureau_relation_citoyen_admin", name="bureau_admin")
     */
    public function bureau_relation_citoyen_admin(): Response
    {
        return $this->render('back/bureau_relation_citoyen_admin.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/admin/news", name="news")
     */
    public function news_show(): Response
    {
   $n = $this->getDoctrine()->getRepository(News::class)->findAll();

        return $this->render('back/news.html.twig', [
            'news' => $n ,
        ]);
    }



}
