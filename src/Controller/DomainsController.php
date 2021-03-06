<?php

namespace App\Controller;

use App\Entity\Domains;
use App\Form\DomainsType;
use App\Repository\DomainsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CertificatesRepository;

/**
 * @Route("/domains")
 */
class DomainsController extends AbstractController
{
    /**
     * @Route("/", name="domains_index", methods={"GET"})
     */
    public function index(
        DomainsRepository $domainsRepository
    ): Response{
        
        
        return $this->render('domains/index.html.twig', [
            'domains' => $domainsRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/new", name="domains_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response{
        $domain = new Domains();
        $domain->setRegistrAr("NameBay.com");
        $form = $this->createForm(DomainsType::class, $domain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($domain);
            $entityManager->flush();
            $this->addFlash('success',$domain->getName().' Successfuly added! ');
            return $this->redirectToRoute('domains_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('domains/new.html.twig', [
            'domain' => $domain,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="domains_show", methods={"GET"})
     */
    public function show(Domains $domain): Response
    {
        return $this->render('domains/show.html.twig', [
            'domain' => $domain,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="domains_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Domains $domain): Response
    {
        $form = $this->createForm(DomainsType::class, $domain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success',$domain->getName().' Successfuly updated! ');
            return $this->redirectToRoute('domains_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('domains/edit.html.twig', [
            'domain' => $domain,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="domains_delete", methods={"POST"})
     */
    public function delete(Request $request, Domains $domain, CertificatesRepository $certificatesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$domain->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $certificate = $certificatesRepository->findCertificateByDomainId($domain->getId());
            if($certificate!=null){
                $entityManager->remove($certificate);
            }
            $entityManager->remove($domain);
            $entityManager->flush();
            $this->addFlash('success',$domain->getName().' Successfuly deleted! ');
        }

        return $this->redirectToRoute('domains_index', [], Response::HTTP_SEE_OTHER);
    }
}
