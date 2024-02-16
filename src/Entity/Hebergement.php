<?php

namespace App\Entity;

use App\Repository\HebergementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HebergementRepository::class)]
class Hebergement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomH = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbrEtoile = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column]
    private ?float $tarifParNuit = null;

    #[ORM\ManyToOne(inversedBy: 'hebergement')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'hebergements')]
    private ?CategorieH $categorieH = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomH(): ?string
    {
        return $this->nomH;
    }

    public function setNomH(string $nomH): static
    {
        $this->nomH = $nomH;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNbrEtoile(): ?int
    {
        return $this->nbrEtoile;
    }

    public function setNbrEtoile(?int $nbrEtoile): static
    {
        $this->nbrEtoile = $nbrEtoile;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getTarifParNuit(): ?float
    {
        return $this->tarifParNuit;
    }

    public function setTarifParNuit(float $tarifParNuit): static
    {
        $this->tarifParNuit = $tarifParNuit;

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

    public function getCategorieH(): ?CategorieH
    {
        return $this->categorieH;
    }

    public function setCategorieH(?CategorieH $categorieH): static
    {
        $this->categorieH = $categorieH;

        return $this;
    }
}
