<?php

namespace App\Controller;

use App\Entity\Documents;
use App\Entity\Quota;
use App\Form\DocumentsType;
use App\Form\QuotaType;
use App\Repository\DocumentsRepository;
use App\Repository\QuotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DocumentsController extends AbstractController
{
    /**
     * @Route("/admin/documents", name="documents_index", methods={"GET"})
     */
    public function index(DocumentsRepository $documentsRepository, QuotaRepository $quotaRepository): Response
    {
        return $this->render('back/documents/index.html.twig', [
            'documents' => $documentsRepository->findAll(),
            'quotas' => $quotaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/documents/new", name="documents_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $document = new Documents();
        $form = $this->createForm(DocumentsType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('docPdf')->getData()){
                $file = $form->get('docPdf')->getData();

                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                // moves the file to the directory where pdf are stored
                $file->move(
                    $this->getParameter('pdf_document_directory'),
                    $fileName
                );

                // updates the 'pdf' property to store the PDF file name
                // instead of its contents
                $document->setDocPdf($fileName);
            }

            /*image*/
            //image
            if($form->get('image')->getData()){
                $fileI = $form->get('image')->getData();
                $fileNameI = $this->generateUniqueFileName().'.'.$fileI->guessExtension();
                $fileI->move ($this->getParameter('images_document_directory'),$fileNameI);
                $document->setImage($fileNameI);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirectToRoute('documents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/documents/new.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/documents/{id}", name="documents_show", methods={"GET"})
     */
    public function show(Documents $document): Response
    {
        return $this->render('back/documents/show.html.twig', [
            'document' => $document,
        ]);
    }

    /**
     * @Route("/admin/documents/{id}/edit", name="documents_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Documents $document): Response
    {
        $cheminPDF=$document->getDocPdf();
        $cheminImage=$document->getImage();
        $form = $this->createForm(DocumentsType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($form->get('docPdf')->getData()){
                $file = $form->get('docPdf')->getData();

                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                // moves the file to the directory where pdf are stored
                $file->move(
                    $this->getParameter('pdf_document_directory'),
                    $fileName
                );

                // updates the 'pdf' property to store the PDF file name
                // instead of its contents
                $document->setDocPdf($fileName);
            }else{
                $document->setDocPdf($cheminPDF);
            }

            /*image*/
            //image
            if($form->get('image')->getData()){
                $fileI = $form->get('image')->getData();
                $fileNameI = $this->generateUniqueFileName().'.'.$fileI->guessExtension();
                $fileI->move ($this->getParameter('images_document_directory'),$fileNameI);
                $document->setImage($fileNameI);
            }else{
                $document->setImage($cheminImage);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/documents/edit.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/documents/{id}", name="documents_delete", methods={"POST"})
     */
    public function delete(Request $request, Documents $document): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($document);
            $entityManager->flush();
        }

        return $this->redirectToRoute('documents_index', [], Response::HTTP_SEE_OTHER);
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

    /******************front*/

}
