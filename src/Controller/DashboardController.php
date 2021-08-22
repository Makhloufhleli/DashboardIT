<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CertificatesRepository;
use App\Repository\DomainsRepository;
use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(
        CertificatesRepository $certificatesRepository,
        DomainsRepository $domainsRepository,
        ClientsRepository $clientsRepository
    ): Response{
        
        $domainsToRenew = new ArrayCollection();
        $certificatesToRenew = new ArrayCollection();
        
        $domains = $domainsRepository->findAll();
        $certificates = $certificatesRepository->findAll();
        
        foreach ($domains as $domain){
            if($domain->getRenewalDate()->format('Y-m') == date('Y-m', strtotime('+1 month'))){
                $domainsToRenew->add($domain);
            }
        }
        
        foreach ($certificates as $certificate){
            if($certificate->getRenewalDate()->format('Y-m') == date('Y-m', strtotime('+1 month'))){
                $certificatesToRenew->add($certificate);
            }
        }
        return $this->render('dashboard/index.html.twig', [
            'clients' => $clientsRepository->findAll(),
            'domains'=> $domainsToRenew,
            'certificates'=>$certificatesToRenew
        ]);
    }
}
