<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "vous devez mettre le type de votre vehicule !!!")]
    private ?string $num_commande = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Length( min: 3, minMessage: 'type de véhicule doit avoir au minimum 3 caractaire',),]
    #[Assert\NotBlank(message: "vous devez mettre le type de votre vehicule !!!")]
    private ?float $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Positive(message: "le code doit etre possitif")]
    #[Assert\NotBlank(message: "vous devez mettre le type de votre vehicule !!!")]
    private ?string $code_promo = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length( min: 3, minMessage: 'type de véhicule doit avoir au minimum 3 caractaire',),]
    #[Assert\NotBlank(message: "vous devez mettre le type de votre vehicule !!!")]
    private ?string $type_paiement = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length( min : 10,minMessage :"Entrer une adresse au min de 10 caracteres")]
    #[Assert\NotBlank(message: "vous devez mettre le type de votre vehicule !!!")]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\NotBlank(message: "vous devez mettre le type de votre vehicule !!!")]
    private ?\DateTimeInterface $date_commande = null;

    #[ORM\OneToOne(mappedBy: 'commande', cascade: ['persist', 'remove'])]
    private ?Reservation $reservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCommande(): ?string
    {
        return $this->num_commande;
    }

    public function setNumCommande(?string $num_commande): static
    {
        $this->num_commande = $num_commande;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCodePromo(): ?string
    {
        return $this->code_promo;
    }

    public function setCodePromo(?string $code_promo): static
    {
        $this->code_promo = $code_promo;

        return $this;
    }

    public function getTypePaiement(): ?string
    {
        return $this->type_paiement;
    }

    public function setTypePaiement(?string $type_paiement): static
    {
        $this->type_paiement = $type_paiement;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(?\DateTimeInterface $date_commande): static
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        // unset the owning side of the relation if necessary
        if ($reservation === null && $this->reservation !== null) {
            $this->reservation->setCommande(null);
        }

        // set the owning side of the relation if necessary
        if ($reservation !== null && $reservation->getCommande() !== $this) {
            $reservation->setCommande($this);
        }

        $this->reservation = $reservation;

        return $this;
    }
    
}
