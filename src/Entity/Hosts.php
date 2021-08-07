<?php

namespace App\Entity;

use App\Repository\HostsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HostsRepository::class)
 */
class Hosts
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
     * @ORM\ManyToOne(targetEntity=AccountsManagers::class, inversedBy="adminHosts")
     */
    private $adminManager;

    /**
     * @ORM\ManyToOne(targetEntity=AccountsManagers::class, inversedBy="technicalHosts")
     */
    private $technicalManager;

    /**
     * @ORM\ManyToOne(targetEntity=AccountsManagers::class, inversedBy="billingHosts")
     */
    private $billingManager;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phpVersion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $discSpace;

    /**
     * @ORM\Column(type="text")
     */
    private $certificate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cdn;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apache_nginx;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $sites = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $databasesLinks = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $backups = [];

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPhpVersion(): ?string
    {
        return $this->phpVersion;
    }

    public function setPhpVersion(string $phpVersion): self
    {
        $this->phpVersion = $phpVersion;

        return $this;
    }

    public function getDiscSpace(): ?string
    {
        return $this->discSpace;
    }

    public function setDiscSpace(string $discSpace): self
    {
        $this->discSpace = $discSpace;

        return $this;
    }

    public function getCertificate(): ?string
    {
        return $this->certificate;
    }

    public function setCertificate(string $certificate): self
    {
        $this->certificate = $certificate;

        return $this;
    }

    public function getCdn(): ?string
    {
        return $this->cdn;
    }

    public function setCdn(string $cdn): self
    {
        $this->cdn = $cdn;

        return $this;
    }

   

    public function getApacheNginx(): ?string
    {
        return $this->apache_nginx;
    }

    public function setApacheNginx(string $apache_nginx): self
    {
        $this->apache_nginx = $apache_nginx;

        return $this;
    }

    public function getSites(): ?array
    {
        return $this->sites;
    }

    public function setSites(?array $sites): self
    {
        $this->sites = $sites;

        return $this;
    }

    public function getDatabasesLinks(): ?array
    {
        return $this->databasesLinks;
    }

    public function setDatabasesLinks(?array $databasesLinks): self
    {
        $this->databasesLinks = $databasesLinks;

        return $this;
    }

    public function getBackups(): ?array
    {
        return $this->backups;
    }

    public function setBackups(?array $backups): self
    {
        $this->backups = $backups;

        return $this;
    }
}
