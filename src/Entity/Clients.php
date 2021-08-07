<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 */
class Clients
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
     * @ORM\OneToMany(targetEntity=Servers::class, mappedBy="client")
     */
    private $servers;

    /**
     * @ORM\OneToMany(targetEntity=Domains::class, mappedBy="client")
     */
    private $domains;

  

    public function __construct()
    {
        $this->servers = new ArrayCollection();
        $this->domains = new ArrayCollection();
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

    /**
     * @return Collection|Servers[]
     */
    public function getServers(): Collection
    {
        return $this->servers;
    }

    public function addServer(Servers $server): self
    {
        if (!$this->servers->contains($server)) {
            $this->servers[] = $server;
            $server->setClient($this);
        }

        return $this;
    }

    public function removeServer(Servers $server): self
    {
        if ($this->servers->removeElement($server)) {
            // set the owning side to null (unless already changed)
            if ($server->getClient() === $this) {
                $server->setClient(null);
            }
        }

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
            $domain->setClient($this);
        }

        return $this;
    }

    public function removeDomain(Domains $domain): self
    {
        if ($this->domains->removeElement($domain)) {
            // set the owning side to null (unless already changed)
            if ($domain->getClient() === $this) {
                $domain->setClient(null);
            }
        }

        return $this;
    }
}
