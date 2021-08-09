<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\ClientsType;
use App\Repository\ClientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clients")
 */
class ClientsController extends AbstractController
{
    /**
     * @Route("/", name="clients_index", methods={"GET","POST"})
     */
    public function index(
        ClientsRepository $clientsRepository,
        Request $request
    ): Response{
        $client = new Clients();
        $form = $this->createForm(ClientsType::class, $client);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash('success',$client->getName().' Successfuly added! ');
            return $this->redirectToRoute('clients_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('clients/index.html.twig', [
            'clients' => $clientsRepository->findAll(),
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="clients_show", methods={"GET"})
     */
    public function show(Clients $client): Response
    {
        return $this->render('clients/show.html.twig', [
            'client' => $client,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="clients_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Clients $client): Response
    {
        $form = $this->createForm(ClientsType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
             $this->addFlash('success',$client->getName().' Successfuly updated! ');
            return $this->redirectToRoute('clients_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('clients/edit.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="clients_delete", methods={"POST"})
     */
    public function delete(Request $request, Clients $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
            $this->addFlash('success',$client->getName().' Successfuly detleted! ');
        }

        return $this->redirectToRoute('clients_index', [], Response::HTTP_SEE_OTHER);
    }
}
