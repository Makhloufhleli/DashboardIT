<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectsRepository::class)
 */
class Projects
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
     * @ORM\ManyToOne(targetEntity=Servers::class, inversedBy="projects")
     */
    private $server;

    /**
     * @ORM\OneToMany(targetEntity=Domains::class, mappedBy="project", cascade={"persist", "remove"})
     */
    private $domains;

    public function __construct()
    {
        $this->domains = new ArrayCollection();
    }

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

    public function getServer(): ?Servers
    {
        return $this->server;
    }

    public function setServer(?Servers $server): self
    {
        $this->server = $server;

        return $this;
    }

    /**
     * @return Collection|Domains[]
     */
    public function getDomains(): Collection
    {
        return $this->domains;
    }

    public function addDomain(Domains $domain): self
    {
        if (!$this->domains->contains($domain)) {
            $this->domains[] = $domain;
            $domain->setProject($this);
        }

        return $this;
    }

    public function removeDomain(Domains $domain): self
    {
        if ($this->domains->removeElement($domain)) {
            // set the owning side to null (unless already changed)
            if ($domain->getProject() === $this) {
                $domain->setProject(null);
            }
        }

        return $this;
    }
}
