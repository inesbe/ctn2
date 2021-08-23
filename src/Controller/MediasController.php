<?php

namespace App\Controller;

use App\Entity\Commentaires;
use App\Entity\CommentairesMedia;
use App\Entity\Guest;
use App\Entity\Medias;
use App\Entity\User;
use App\Form\CommentaireGguestType;
use App\Form\CommentairesMediaType;
use App\Form\MediasType;
use App\Repository\MediasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class MediasController extends AbstractController
{
    /**
     * @Route("/admin/medias", name="medias_index", methods={"GET"})
     */
    public function index(MediasRepository $mediasRepository): Response
    {
        return $this->render('back/medias/index.html.twig', [
            'medias' => $mediasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/medias/new", name="medias_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $media = new Medias();
        $form = $this->createForm(MediasType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($form->get('video')->getData()){
                $file = $form->get('video')->getData();

                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                // moves the file to the directory where pdf are stored
                $file->move(
                    $this->getParameter('media_mp4_directory'),
                    $fileName
                );

                $media->setVideo($fileName);

            }

            if($form->get('image')->getData()){

                //image
                $fileI = $form->get('image')->getData();
                $fileNameI = $this->generateUniqueFileName().'.'.$fileI->guessExtension();
                $fileI->move ($this->getParameter('images_media_directory'),$fileNameI);
                $media->setImage($fileNameI);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($media);
            $entityManager->flush();

            return $this->redirectToRoute('medias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/medias/new.html.twig', [
            'media' => $media,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/medias/{id}", name="medias_show", methods={"GET"})
     */
    public function show(Medias $media): Response
    {
        return $this->render('back/medias/show.html.twig', [
            'media' => $media,
        ]);
    }

    /**
     * @Route("/admin/medias/{id}/edit", name="medias_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Medias $media): Response
    {
        $imagechemin=$media->getImage();
        $videoChemain=$media->getVideo();
        $form = $this->createForm(MediasType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('video')->getData()){
                $file = $form->get('video')->getData();

                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                // moves the file to the directory where pdf are stored
                $file->move(
                    $this->getParameter('media_mp4_directory'),
                    $fileName
                );

                $media->setVideo($fileName);

            }else{
                $media->setVideo($videoChemain);
            }

            if($form->get('image')->getData()){

                //image
                $fileI = $form->get('image')->getData();
                $fileNameI = $this->generateUniqueFileName().'.'.$fileI->guessExtension();
                $fileI->move ($this->getParameter('images_media_directory'),$fileNameI);
                $media->setImage($fileNameI);
            }else{
                $media->setImage($imagechemin);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/medias/edit.html.twig', [
            'media' => $media,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/medias/{id}", name="medias_delete", methods={"POST"})
     */
    public function delete(Request $request, Medias $media): Response
    {
        if ($this->isCsrfTokenValid('delete'.$media->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($media);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medias_index', [], Response::HTTP_SEE_OTHER);
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

    /***************front****/
    /**
     * @Route("/medias/{id}", name="media_details", methods={"GET","POST"})
     */
    public function media_details(Medias $media,Request $request,$id): Response
    {
        $u=$this->getUser();


        $commentaire = new CommentairesMedia();
        $formU = $this->createForm(CommentairesMediaType::class, $commentaire);
        $formU->handleRequest($request);

        if ($formU->isSubmitted() && $formU->isValid()) {
            if($u){

                $commentaire->setMedias($media);
                $commentaire->setUser($u);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($commentaire);
                $entityManager->flush();
            }

            return $this->redirectToRoute('media_details', ["id"=>$id], Response::HTTP_SEE_OTHER);
        }

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

            $commentaire->setCommentaireMed($form->get('commentaire')->getData());
            $commentaire->setMedias($media);
            $commentaire->setGuest($guest);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();


            return $this->redirectToRoute('media_details', ["id" => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/medias/details_media.html.twig', [
            'form'=>$form->createView(),
            'media' => $media,
            'formU' => $formU->createView(),
        ]);
    }

}
