<?php

namespace App\Controller;

use App\Entity\Certificates;
use App\Form\CertificatesType;
use App\Repository\CertificatesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/certificates")
 */
class CertificatesController extends AbstractController
{
    /**
     * @Route("/", name="certificates_index", methods={"GET"})
     */
    public function index(CertificatesRepository $certificatesRepository): Response
    {
        return $this->render('certificates/index.html.twig', [
            'certificates' => $certificatesRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/new", name="certificates_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response{
        $certificate = new Certificates();
        $form = $this->createForm(CertificatesType::class, $certificate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($certificate->getRenewalMode() == 'auto' && $certificate->getRenewalDate() == null){
                $creationDate = $certificate->getCreationDate();
                
                $d = new \DateTime();
                $d->setDate($creationDate->format('Y'), $creationDate->format('m'), $creationDate->format('d'));
                $d->setTimestamp($creationDate->getTimestamp());
                $d->setTimezone($creationDate->getTimezone());
                $renewalDate = $d->add(new \DateInterval('P1Y'));
                
                $certificate->setRenewalDate($renewalDate);
            }
            $entityManager = $this->getDoctrine()->getManager();
            if($certificate->getDomain() != null){
                $certificate->getDomain()->setHasCertificate(true);
            }
            if($certificate->getHost() != null){
                $certificate->getHost()->setHasCertificate(true);
            }
            $entityManager->persist($certificate);
            $entityManager->flush();
            $this->addFlash('success','Certificate successfuly added! ');
            return $this->redirectToRoute('certificates_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('certificates/new.html.twig', [
            'certificate' => $certificate,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="certificates_show", methods={"GET"})
     */
    public function show(Certificates $certificate): Response
    {
        return $this->render('certificates/show.html.twig', [
            'certificate' => $certificate,
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
            $this->addFlash('success','Certificate successfuly updated! ');
            return $this->redirectToRoute('certificates_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('certificates/edit.html.twig', [
            'certificate' => $certificate,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="certificates_delete", methods={"POST"})
     */
    public function delete(Request $request, Certificates $certificate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$certificate->getId(), $request->request->get('_token'))) {
            $certificate->getDomain()->setHasCertificate(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($certificate);
            $entityManager->flush();
            $this->addFlash('success','Certificate successfuly deleted! ');
        }

        return $this->redirectToRoute('certificates_index', [], Response::HTTP_SEE_OTHER);
    }
}
