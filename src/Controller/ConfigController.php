<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//user dependencies
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;

//AccountsManagers dependencies
use App\Entity\AccountsManagers;
use App\Form\AccountsManagersType;
use App\Repository\AccountsManagersRepository;

//Projects dependencies
use App\Entity\Projects;
use App\Form\ProjectsType;
use App\Repository\ProjectsRepository;

//Clients dependecies
use App\Entity\Clients;
use App\Form\ClientsType;
use App\Repository\ClientsRepository;

class ConfigController extends AbstractController {

    /**
     * @Route("/config", name="config")
     */
    public function index(
        ClientsRepository $clientsRepository,
        ProjectsRepository $projectsRepository,
        AccountsManagersRepository $accountsManagersRepository,
        UserRepository $userRepository
    ): Response {
        return $this->render('config/index.html.twig', [
            'clients' => $clientsRepository->findAll(),
            'projects'=>$projectsRepository->findAll(),
            'accountsManagers'=>$accountsManagersRepository->findAll(),
            'users'=>$userRepository->findAll()
        ]);
    }

}
