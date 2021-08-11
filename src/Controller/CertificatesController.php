<?php

namespace App\Controller;

use App\Form\CertificatesType;
use App\Entity\Certificates;
use App\Repository\CertificatesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CertificatesController extends AbstractController
{
    /**
     * @Route("/", name="certificates_index", methods={"GET","POST"})
     */
    public function index(
        CertificatesRepository $CertificatesRepository,
        Request $request
    ): Response
    { $certificate = new Certificates();
        $form = $this->createForm(CertificatesType::class, $certificate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($certificate);
            $entityManager->flush();
            $this->addFlash('success Certificate ',$certificate->getDomain().' Successfuly added! ');
            return $this->redirectToRoute('certificates_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('certificates/index.html.twig', [
            'certificates' => $CertificatesRepository->findAll(),
            'certificates' => $certificate,
            'form' => $form->createView(),
        ]);
    }
 

     /**
     * @Route("/{id}/edit", name="certificates_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Certificates $certificate): Response
    {
        $form = $this->createForm(CertificatesType::class, $certificate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success',$certificate->getDomain().' Successfuly updated! ');
            return $this->redirectToRoute('certificates_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('certificates/edit.html.twig', [
            'certificates' => $certificate,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="certificates_delete", methods={"POST"})
     */
    public function delete(Request $request, Certificates $certificate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$certificate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($certificate);
            $entityManager->flush();
            $this->addFlash('success',$certificate->getDomain().' Successfuly detleted! ');
        }

        return $this->redirectToRoute('certificates_index', [], Response::HTTP_SEE_OTHER);
    }
}
