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
    #[Assert\Length( min: 3, minMessage: 'Le nom doit contenir au moins 3 lettres',),]
    #[Assert\NotBlank(message: "Il faut saisir le nom !!!")]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\GreaterThan('today' , message: "la date  de tournée doit etre supérieure à la date d'aujourd'hui !!")]
    #[Assert\NotBlank(message: "Il faut saisir la date !!!")]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Il faut saisir la durée !!!")]
    #[Assert\Positive(message:'Veuillez choisir une duree positive !')]
    #[Assert\Length( min: 2, minMessage: 'La durée doit contenir au moins 2 lettres',),]
    private ?string $duree = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Il faut saisir la description !!!")]
    #[Assert\Length( min: 10, minMessage: 'La description doit contenir au moins 10 lettres',),]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Length( min: 2, minMessage: 'Le tarif doit contenir au moins 2 chiffres',),]
    #[Assert\Positive(message:'Veuillez choisir un tarif positif !')]
    #[Assert\NotBlank(message: "Il faut saisir le tarif !!!")]
    private ?float $tarif = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Il faut saisir les monuments !!!")]
    #[Assert\Length( min: 4, minMessage: 'Les doivent contenir au moins 4 lettres',),]
    private ?string $monuments = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Il faut saisir la tranche d'àge!!!")]
    #[Assert\Positive(message:'Veuillez choisir un tranche d age positif !')]
    #[Assert\Length( min: 3, minMessage: 'La description doit contenir au moins 3 caractères',),]
    private ?string $trancheAge = null;

    #[ORM\Column(length: 255, nullable: true)]
   
    #[Assert\NotBlank(message: "Il faut saisir le moyen de transport !!!")]
    #[Assert\Length( min: 3, minMessage: 'Le moyen de transport doit contenir au moins 3 lettres',),]
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
