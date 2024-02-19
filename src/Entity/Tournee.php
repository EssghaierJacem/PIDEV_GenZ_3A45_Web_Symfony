<?php

namespace App\Entity;

use App\Repository\TourneeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TourneeRepository::class)]
class Tournee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length( min: 3, minMessage: '...',),]
    #[Assert\NotBlank(message: "... !!!")]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\GreaterThan('today' , message: "la date  de tournée doit etre supérieure à la date d'aujourd'hui !!")]
    #[Assert\NotBlank(message: "... !!!")]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "... !!!")]
    #[Assert\Length( min: 3, minMessage: '...',),]
    private ?string $duree = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "... !!!")]
    #[Assert\Length( min: 3, minMessage: '...',),]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    
    #[Assert\NotBlank(message: "... !!!")]
    private ?float $tarif = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "... !!!")]
    #[Assert\Length( min: 3, minMessage: '...',),]
    private ?string $monuments = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "...!!!")]
    #[Assert\Length( min: 3, minMessage: '...',),]
    private ?string $trancheAge = null;

    #[ORM\Column(length: 255, nullable: true)]
   
    #[Assert\NotBlank(message: "... !!!")]
    #[Assert\Length( min: 3, minMessage: '...',),]
    private ?string $moyenTransport = null;

    #[ORM\ManyToOne(inversedBy: 'tournee')]
    #[Assert\NotBlank(message: "vous devez choisir un pays !!!")]
    private ?Destination $destination = null;

    #[ORM\ManyToOne(inversedBy: 'tournees')]
    #[Assert\NotBlank(message: "vous devez choisir un guide !!!")]
    private ?Guide $guide = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(?float $tarif): static
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getMonuments(): ?string
    {
        return $this->monuments;
    }

    public function setMonuments(?string $monuments): static
    {
        $this->monuments = $monuments;

        return $this;
    }

    public function getTrancheAge(): ?string
    {
        return $this->trancheAge;
    }

    public function setTrancheAge(?string $trancheAge): static
    {
        $this->trancheAge = $trancheAge;

        return $this;
    }

    public function getMoyenTransport(): ?string
    {
        return $this->moyenTransport;
    }

    public function setMoyenTransport(?string $moyenTransport): static
    {
        $this->moyenTransport = $moyenTransport;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getGuide(): ?Guide
    {
        return $this->guide;
    }

    public function setGuide(?Guide $guide): static
    {
        $this->guide = $guide;

        return $this;
    }
}
