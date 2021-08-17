<?php

namespace App\Controller;

use App\Entity\Servers;
use App\Form\ServersType;
use App\Repository\ServersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/servers")
 */
class ServersController extends AbstractController {

    /**
     * @Route("/", name="servers_index", methods={"GET"})
     */
    public function index(
            ServersRepository $serversRepository
    ): Response {
        $servers = $serversRepository->findAll();
        return $this->render('servers/index.html.twig', [
                    'servers' => $servers,
        ]);
    }

    /**
     * @Route("/new", name="servers_new", methods={"GET","POST"})
     */
    public function new(
            ServersRepository $serversRepository,
            Request $request,
            ValidatorInterface $validator
    ): Response {
        $servers = $serversRepository->findAll();
        $server = new Servers();
        $form = $this->createForm(ServersType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($server);
            $entityManager->flush();
            $this->addFlash('success', $server->getName() . ' Successfuly added! ');
            return $this->redirectToRoute('servers_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('servers/new.html.twig', [
                    'server' => $server,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="servers_show", methods={"GET"})
     */
    public function show(Servers $server): Response {
        return $this->render('servers/show.html.twig', [
                    'server' => $server,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="servers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Servers $server): Response {
        $form = $this->createForm(ServersType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', $server->getName() . ' Successfuly deleted! ');
            return $this->redirectToRoute('servers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('servers/edit.html.twig', [
                    'server' => $server,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="servers_delete", methods={"POST"})
     */
    public function delete(Request $request, Servers $server): Response {
        if ($this->isCsrfTokenValid('delete' . $server->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($server);
            $entityManager->flush();
            $this->addFlash('success', $server->getName() . ' Successfuly deleted! ');
        }

        return $this->redirectToRoute('servers_index', [], Response::HTTP_SEE_OTHER);
    }

}
