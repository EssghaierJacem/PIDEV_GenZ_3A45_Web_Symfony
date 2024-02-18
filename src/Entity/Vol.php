<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: VolRepository::class)]
class Vol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Length(min:4, minMessage: 'Minmum 4 caractère')]
    #[ORM\Column(length: 255)]
    private ?string $compagnieA = null;

    #[Assert\Positive(message:'Veuillez choisir un entier positif!')]
    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[ORM\Column]
    private ?int $num_vol = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Length(min:5, minMessage: 'Minmum 5 caractère')]
    #[ORM\Column(length: 255)]
    private ?string $aeroportDepart = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Length(min:5, minMessage: 'Minmum 5 caractère')]
    #[ORM\Column(length: 255)]
    private ?string $aeroportArrivee = null;

    #[Assert\GreaterThan('today',
    message:"La date de départ doit être ultérieure à aujourd'hui!")]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDepart = null;

    #[Assert\GreaterThan('today',
        message:"La date d'arrivée' doit être ultérieure à aujourd'hui!")]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateArrivee = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Positive(message:'Durée de vol doit etre positive!')]
    #[ORM\Column]
    private ?int $duree_vol = null;
    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Range(
        min: 50,
        max: 5000,
        notInRangeMessage: 'le tarif acceptable est entre {{ min }} dt et {{ max }} dt ',
    )]
    #[ORM\Column]
    private ?float $tarif = null;

    #[ORM\ManyToOne(inversedBy: 'vol')]
    private ?Destination $destination = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompagnieA(): ?string
    {
        return $this->compagnieA;
    }

    public function setCompagnieA(string $compagnieA): static
    {
        $this->compagnieA = $compagnieA;

        return $this;
    }

    public function getNumVol(): ?int
    {
        return $this->num_vol;
    }

    public function setNumVol(int $num_vol): static
    {
        $this->num_vol = $num_vol;

        return $this;
    }

    public function getAeroportDepart(): ?string
    {
        return $this->aeroportDepart;
    }

    public function setAeroportDepart(string $aeroportDepart): static
    {
        $this->aeroportDepart = $aeroportDepart;

        return $this;
    }

    public function getAeroportArrivee(): ?string
    {
        return $this->aeroportArrivee;
    }

    public function setAeroportArrivee(string $aeroportArrivee): static
    {
        $this->aeroportArrivee = $aeroportArrivee;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): static
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(\DateTimeInterface $dateArrivee): static
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getDureeVol(): ?int
    {
        return $this->duree_vol;
    }

    public function setDureeVol(int $duree_vol): static
    {
        $this->duree_vol = $duree_vol;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): static
    {
        $this->tarif = $tarif;

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
}
