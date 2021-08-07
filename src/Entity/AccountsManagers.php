<?php

namespace App\Entity;

use App\Repository\AccountsManagersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccountsManagersRepository::class)
 */
class AccountsManagers
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
     * @ORM\Column(type="string", length=255)
     */
    private $function;

    /**
     * @ORM\OneToMany(targetEntity=Domains::class, mappedBy="adminManager")
     */
    private $adminDomains;

    /**
     * @ORM\OneToMany(targetEntity=Domains::class, mappedBy="technicalManager")
     */
    private $technicalDomains;

    /**
     * @ORM\OneToMany(targetEntity=Domains::class, mappedBy="billingManager")
     */
    private $billingDomains;

    /**
     * @ORM\OneToMany(targetEntity=Hosts::class, mappedBy="adminManager")
     */
    private $adminHosts;

    /**
     * @ORM\OneToMany(targetEntity=Hosts::class, mappedBy="technicalManager")
     */
    private $technicalHosts;

    /**
     * @ORM\OneToMany(targetEntity=Hosts::class, mappedBy="billingManager")
     */
    private $billingHosts;

    /**
     * @ORM\OneToMany(targetEntity=Servers::class, mappedBy="adminManager")
     */
    private $adminServers;

    /**
     * @ORM\OneToMany(targetEntity=Servers::class, mappedBy="technicalManager")
     */
    private $technicalServers;

    /**
     * @ORM\OneToMany(targetEntity=Servers::class, mappedBy="billingManager")
     */
    private $billingServers;


    public function __construct()
    {
        $this->adminDomains = new ArrayCollection();
        $this->technicalDomains = new ArrayCollection();
        $this->billingDomains = new ArrayCollection();
        $this->adminHosts = new ArrayCollection();
        $this->technicalHosts = new ArrayCollection();
        $this->billingHosts = new ArrayCollection();
        $this->adminServers = new ArrayCollection();
        $this->technicalServers = new ArrayCollection();
        $this->billingServers = new ArrayCollection();
    }

    public function __toString(){
        return(String) $this->getName();
    }

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

    public function getFunction(): ?string
    {
        return $this->function;
    }

    public function setFunction(string $function): self
    {
        $this->function = $function;

        return $this;
    }

    /**
     * @return Collection|Domains[]
     */
    public function getAdminDomains(): Collection
    {
        return $this->adminDomains;
    }

    public function addAdminDomain(Domains $adminDomain): self
    {
        if (!$this->adminDomains->contains($adminDomain)) {
            $this->adminDomains[] = $adminDomain;
            $adminDomain->setAdminManager($this);
        }

        return $this;
    }

    public function removeAdminDomain(Domains $adminDomain): self
    {
        if ($this->adminDomains->removeElement($adminDomain)) {
            // set the owning side to null (unless already changed)
            if ($adminDomain->getAdminManager() === $this) {
                $adminDomain->setAdminManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Domains[]
     */
    public function getTechnicalDomains(): Collection
    {
        return $this->technicalDomains;
    }

    public function addTechnicalDomain(Domains $technicalDomain): self
    {
        if (!$this->technicalDomains->contains($technicalDomain)) {
            $this->technicalDomains[] = $technicalDomain;
            $technicalDomain->setTechnicalManager($this);
        }

        return $this;
    }

    public function removeTechnicalDomain(Domains $technicalDomain): self
    {
        if ($this->technicalDomains->removeElement($technicalDomain)) {
            // set the owning side to null (unless already changed)
            if ($technicalDomain->getTechnicalManager() === $this) {
                $technicalDomain->setTechnicalManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Domains[]
     */
    public function getBillingDomains(): Collection
    {
        return $this->billingDomains;
    }

    public function addBillingDomain(Domains $billingDomain): self
    {
        if (!$this->billingDomains->contains($billingDomain)) {
            $this->billingDomains[] = $billingDomain;
            $billingDomain->setBillingManager($this);
        }

        return $this;
    }

    public function removeBillingDomain(Domains $billingDomain): self
    {
        if ($this->billingDomains->removeElement($billingDomain)) {
            // set the owning side to null (unless already changed)
            if ($billingDomain->getBillingManager() === $this) {
                $billingDomain->setBillingManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hosts[]
     */
    public function getAdminHosts(): Collection
    {
        return $this->adminHosts;
    }

    public function addAdminHost(Hosts $adminHost): self
    {
        if (!$this->adminHosts->contains($adminHost)) {
            $this->adminHosts[] = $adminHost;
            $adminHost->setAdminManager($this);
        }

        return $this;
    }

    public function removeAdminHost(Hosts $adminHost): self
    {
        if ($this->adminHosts->removeElement($adminHost)) {
            // set the owning side to null (unless already changed)
            if ($adminHost->getAdminManager() === $this) {
                $adminHost->setAdminManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hosts[]
     */
    public function getTechnicalHosts(): Collection
    {
        return $this->technicalHosts;
    }

    public function addTechnicalHost(Hosts $technicalHost): self
    {
        if (!$this->technicalHosts->contains($technicalHost)) {
            $this->technicalHosts[] = $technicalHost;
            $technicalHost->setTechnicalManager($this);
        }

        return $this;
    }

    public function removeTechnicalHost(Hosts $technicalHost): self
    {
        if ($this->technicalHosts->removeElement($technicalHost)) {
            // set the owning side to null (unless already changed)
            if ($technicalHost->getTechnicalManager() === $this) {
                $technicalHost->setTechnicalManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hosts[]
     */
    public function getBillingHosts(): Collection
    {
        return $this->billingHosts;
    }

    public function addBillingHost(Hosts $billingHost): self
    {
        if (!$this->billingHosts->contains($billingHost)) {
            $this->billingHosts[] = $billingHost;
            $billingHost->setBillingManager($this);
        }

        return $this;
    }

    public function removeBillingHost(Hosts $billingHost): self
    {
        if ($this->billingHosts->removeElement($billingHost)) {
            // set the owning side to null (unless already changed)
            if ($billingHost->getBillingManager() === $this) {
                $billingHost->setBillingManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Servers[]
     */
    public function getAdminServers(): Collection
    {
        return $this->adminServers;
    }

    public function addAdminServer(Servers $adminServer): self
    {
        if (!$this->adminServers->contains($adminServer)) {
            $this->adminServers[] = $adminServer;
            $adminServer->setAdminManager($this);
        }

        return $this;
    }

    public function removeAdminServer(Servers $adminServer): self
    {
        if ($this->adminServers->removeElement($adminServer)) {
            // set the owning side to null (unless already changed)
            if ($adminServer->getAdminManager() === $this) {
                $adminServer->setAdminManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Servers[]
     */
    public function getTechnicalServers(): Collection
    {
        return $this->technicalServers;
    }

    public function addTechnicalServer(Servers $technicalServer): self
    {
        if (!$this->technicalServers->contains($technicalServer)) {
            $this->technicalServers[] = $technicalServer;
            $technicalServer->setTechnicalManager($this);
        }

        return $this;
    }

    public function removeTechnicalServer(Servers $technicalServer): self
    {
        if ($this->technicalServers->removeElement($technicalServer)) {
            // set the owning side to null (unless already changed)
            if ($technicalServer->getTechnicalManager() === $this) {
                $technicalServer->setTechnicalManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Servers[]
     */
    public function getBillingServers(): Collection
    {
        return $this->billingServers;
    }

    public function addBillingServer(Servers $billingServer): self
    {
        if (!$this->billingServers->contains($billingServer)) {
            $this->billingServers[] = $billingServer;
            $billingServer->setBillingManager($this);
        }

        return $this;
    }

    public function removeBillingServer(Servers $billingServer): self
    {
        if ($this->billingServers->removeElement($billingServer)) {
            // set the owning side to null (unless already changed)
            if ($billingServer->getBillingManager() === $this) {
                $billingServer->setBillingManager(null);
            }
        }

        return $this;
    }

}
