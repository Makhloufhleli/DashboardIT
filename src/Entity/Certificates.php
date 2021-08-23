<?php

namespace App\Entity;

use App\Repository\CertificatesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToOne(targetEntity=Domains::class,)
     * @ORM\JoinColumn(name="domain_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $domain;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $creationDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $renewalMode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $issuer;

    /**
     * @ORM\Column(type="date")
     */
    private $renewalDate;

    /**
     * @ORM\OneToOne(targetEntity=Hosts::class, inversedBy="certificate")
     * @ORM\JoinColumn(name="host_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $host;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $sshKey;


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

    public function getHost(): ?Hosts
    {
        return $this->host;
    }

    public function setHost(?Hosts $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getSshKey(): ?string
    {
        return $this->sshKey;
    }

    public function setSshKey(string $sshKey): self
    {
        $this->sshKey = $sshKey;

        return $this;
    }


}
