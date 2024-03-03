<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "vous devez saisir le nom de client !!!")]
    private ?string $nom_client = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "vous devez saisir le prenom de client !!!")]
    private ?string $prenom_client = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Length( min : 8,minMessage :"Entrer num au min de 8 caracteres")]    private ?int $num_tel = null;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message: "vous devez saisir le quantité !!!")]
    private ?int $quantite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\NotBlank(message: "La date de réservation est requise.")]
    #[Assert\GreaterThan("today", message: "La date de réservation doit être dans le futur.")]
    private ?\DateTimeInterface $date_reservation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $qr_code = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    private ?User $user = null;

    #[ORM\OneToOne(inversedBy: 'reservation', cascade: ['persist', 'remove'])]
    private ?Commande $commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nom_client;
    }

    public function setNomClient(string $nom_client): static
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenom_client;
    }

    public function setPrenomClient(?string $prenom_client): static
    {
        $this->prenom_client = $prenom_client;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->num_tel;
    }

    public function setNumTel(?int $num_tel): static
    {
        $this->num_tel = $num_tel;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(?\DateTimeInterface $date_reservation): static
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getQrCode(): ?string
    {
        return $this->qr_code;
    }

    public function setQrCode(?string $qr_code): static
    {
        $this->qr_code = $qr_code;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }
}
