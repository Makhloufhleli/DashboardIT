<?php

namespace App\Controller;

use App\Entity\AccountsManagers;
use App\Form\AccountsManagersType;
use App\Repository\AccountsManagersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accounts/managers")
 */
class AccountsManagersController extends AbstractController
{
    /**
     * @Route("/", name="accounts_managers_index", methods={"GET","POST"})
     */
    public function index(
        AccountsManagersRepository $accountsManagersRepository,
        Request $request
    ): Response{
        
        $accountsManager = new AccountsManagers();
        $form = $this->createForm(AccountsManagersType::class, $accountsManager);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accountsManager);
            $entityManager->flush();
            $this->addFlash('success',$accountsManager->getName().' Successfuly added! ');
            return $this->redirectToRoute('accounts_managers_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('accounts_managers/index.html.twig', [
            'accounts_managers' => $accountsManagersRepository->findAll(),
            'accounts_manager' => $accountsManager,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="accounts_managers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AccountsManagers $accountsManager): Response
    {
        $form = $this->createForm(AccountsManagersType::class, $accountsManager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success',$accountsManager->getName().' Successfuly updated! ');
            return $this->redirectToRoute('accounts_managers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('accounts_managers/edit.html.twig', [
            'accounts_manager' => $accountsManager,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="accounts_managers_delete", methods={"POST"})
     */
    public function delete(Request $request, AccountsManagers $accountsManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accountsManager->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accountsManager);
            $entityManager->flush();
            $this->addFlash('success',$accountsManager->getName().' Successfuly detleted! ');
        }

        return $this->redirectToRoute('accounts_managers_index', [], Response::HTTP_SEE_OTHER);
    }
}
