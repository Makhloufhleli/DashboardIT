<?php

namespace App\Entity;

use App\Repository\ServersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServersRepository::class)
 */
class Servers
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
     * @ORM\ManyToOne(targetEntity=AccountsManagers::class, inversedBy="adminServers")
     */
    private $adminManager;

    /**
     * @ORM\ManyToOne(targetEntity=AccountsManagers::class, inversedBy="technicalServers")
     */
    private $technicalManager;

    /**
     * @ORM\ManyToOne(targetEntity=AccountsManagers::class, inversedBy="billingServers")
     */
    private $billingManager;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ipAdress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $projectPublicCloud;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dataCenter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subscription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operatingSystem;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cpu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ram;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $discSpace;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $extraDisc;

    /**
     * @ORM\OneToMany(targetEntity=Projects::class, mappedBy="server")
     */
    private $projects;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apache_nginx;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="servers")
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

   

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }
    
    public function __toString() {
        return (String) $this->getName();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIpAdress(): ?string
    {
        return $this->ipAdress;
    }

    public function setIpAdress(string $ipAdress): self
    {
        $this->ipAdress = $ipAdress;

        return $this;
    }

    public function getProjectPublicCloud(): ?string
    {
        return $this->projectPublicCloud;
    }

    public function setProjectPublicCloud(string $projectPublicCloud): self
    {
        $this->projectPublicCloud = $projectPublicCloud;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getDataCenter(): ?string
    {
        return $this->dataCenter;
    }

    public function setDataCenter(string $dataCenter): self
    {
        $this->dataCenter = $dataCenter;

        return $this;
    }

    public function getSubscription(): ?string
    {
        return $this->subscription;
    }

    public function setSubscription(string $subscription): self
    {
        $this->subscription = $subscription;

        return $this;
    }

    public function getOperatingSystem(): ?string
    {
        return $this->operatingSystem;
    }

    public function setOperatingSystem(string $operatingSystem): self
    {
        $this->operatingSystem = $operatingSystem;

        return $this;
    }
    
    public function getCpu(): ?string
    {
        return $this->cpu;
    }

    public function setCpu(string $cpu): self
    {
        $this->cpu = $cpu;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(string $ram): self
    {
        $this->ram = $ram;

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

    public function getExtraDisc(): ?string
    {
        return $this->extraDisc;
    }

    public function setExtraDisc(string $extraDisc): self
    {
        $this->extraDisc = $extraDisc;

        return $this;
    }

    /**
     * @return Collection|Projects[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Projects $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setServer($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getServer() === $this) {
                $project->setServer(null);
            }
        }

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

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }
}
