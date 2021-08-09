<?php

namespace App\Entity;

use App\Repository\DomainsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomainsRepository::class)
 */
class Domains
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;


    /**
     * @ORM\OneToOne(targetEntity=Projects::class, cascade={"persist", "remove"})
     */
    private $project;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $registrAr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $registrAnt;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ns1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ns2;

    /**
     * @ORM\ManyToOne(targetEntity=AccountsManagers::class, inversedBy="adminDomains")
     */
    private $adminManager;

    /**
     * @ORM\ManyToOne(targetEntity=AccountsManagers::class, inversedBy="technicalDomains")
     */
    private $technicalManager;

    /**
     * @ORM\ManyToOne(targetEntity=AccountsManagers::class, inversedBy="billingDomains")
     */
    private $billingManager;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="domains")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function __toString() {
        return (String) $this->getName();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getProject(): ?Projects
    {
        return $this->project;
    }

    public function setProject(?Projects $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getRegistrAr(): ?string
    {
        return $this->registrAr;
    }

    public function setRegistrAr(string $registrAr): self
    {
        $this->registrAr = $registrAr;

        return $this;
    }

    public function getRegistrAnt(): ?string
    {
        return $this->registrAnt;
    }

    public function setRegistrAnt(string $registrAnt): self
    {
        $this->registrAnt = $registrAnt;

        return $this;
    }

    public function getNs1(): ?string
    {
        return $this->ns1;
    }

    public function setNs1(string $ns1): self
    {
        $this->ns1 = $ns1;

        return $this;
    }

    public function getNs2(): ?string
    {
        return $this->ns2;
    }

    public function setNs2(string $ns2): self
    {
        $this->ns2 = $ns2;

        return $this;
    }

    public function getAdminManager(): ?AccountsManagers
    {
        return $this->adminManager;
    }

    public function setAdminManager(?AccountsManagers $adminManager): self
    {
        $this->adminManager = $adminManager;

        return $this;
    }

    public function getTechnicalManager(): ?AccountsManagers
    {
        return $this->technicalManager;
    }

    public function setTechnicalManager(?AccountsManagers $technicalManager): self
    {
        $this->technicalManager = $technicalManager;

        return $this;
    }

    public function getBillingManager(): ?AccountsManagers
    {
        return $this->billingManager;
    }

    public function setBillingManager(?AccountsManagers $billingManager): self
    {
        $this->billingManager = $billingManager;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }
}
