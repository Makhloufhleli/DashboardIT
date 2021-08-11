<?php

namespace App\Entity;

use App\Repository\CertificatesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CertificatesRepository::class)
 */
class Certificates
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Domains::class, cascade={"persist", "remove"})
     */
    private $domain;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $renewalMode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $issuer;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $renewalDate;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomain(): ?Domains
    {
        return $this->domain;
    }

    public function setDomain(?Domains $domain): self
    {
        $this->domain = $domain;

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

    

    public function getRenewalMode(): ?string
    {
        return $this->renewalMode;
    }

    public function setRenewalMode(string $renewalMode): self
    {
        $this->renewalMode = $renewalMode;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getIssuer(): ?string
    {
        return $this->issuer;
    }

    public function setIssuer(string $issuer): self
    {
        $this->issuer = $issuer;

        return $this;
    }

    function getRenewalDate() {
        return $this->renewalDate;
    }

    function setRenewalDate($renewalDate): void {
        $this->renewalDate = $renewalDate;
    }


}
