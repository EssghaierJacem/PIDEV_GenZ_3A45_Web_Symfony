<?php

namespace App\Entity;

use App\Repository\GuideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: GuideRepository::class)]
class Guide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length( min: 3, minMessage: 'Le nom doit contenir au moins 3 lettres ',),]
   
    #[Assert\NotBlank(message: "Il faut saisir un nom !!!")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length( min: 4, minMessage: 'Le prenom doit contenir au moins 4 lettres',),]
    #[Assert\NotBlank(message: "Il faut saisir un prénom !!!")]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length( min: 3, minMessage: 'La nationalité doit contenir au moins 3 lettres ',),]
    #[Assert\NotBlank(message: "Il faut saisir une nationalité !!!")]
    private ?string $nationalite = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length( min: 5, minMessage: 'Les langues doit contenir au moins 5 lettres',),]
    #[Assert\NotBlank(message: "Il faut saisir les langues !!!")]
    private ?string $languesParlees = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length( min: 2, minMessage: 'L experience doit contenir au moins 2 lettres',),]
    #[Assert\NotBlank(message: "Il faut saisir les expériences !!!")]
    private ?string $experiences = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Length( min: 2, minMessage: 'Le tarif horaire doit contenir au moins 2 chiffres',),]
    #[Assert\Positive(message:'Veuillez choisir un tarif horaire positif !')]
    #[Assert\NotBlank(message: "Il faut saisir le tarif horaire !!!")]
    private ?float $tarifHoraire = null;

    #[ORM\Column(nullable: true)]
   
    #[Assert\Length( min: 8, minMessage: 'Le numéro de télephone doit contenir au moins 8 chiffres',),]
    #[Assert\NotBlank(message: "Il faut saisir le numéro de télephone !!!")]
    private ?int $num_tel = null;

    #[ORM\OneToMany(mappedBy: 'guide', targetEntity: Tournee::class)]
    private Collection $tournees;

    public function __construct()
    {
        $this->tournees = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(?string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getLanguesParlees(): ?string
    {
        return $this->languesParlees;
    }

    public function setLanguesParlees(?string $languesParlees): static
    {
        $this->languesParlees = $languesParlees;

        return $this;
    }

    public function getExperiences(): ?string
    {
        return $this->experiences;
    }

    public function setExperiences(?string $experiences): static
    {
        $this->experiences = $experiences;

        return $this;
    }

    public function getTarifHoraire(): ?float
    {
        return $this->tarifHoraire;
    }

    public function setTarifHoraire(?float $tarifHoraire): static
    {
        $this->tarifHoraire = $tarifHoraire;

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

    /**
     * @return Collection<int, Tournee>
     */
    public function getTournees(): Collection
    {
        return $this->tournees;
    }

    public function addTournee(Tournee $tournee): static
    {
        if (!$this->tournees->contains($tournee)) {
            $this->tournees->add($tournee);
            $tournee->setGuide($this);
        }

        return $this;
    }

    public function removeTournee(Tournee $tournee): static
    {
        if ($this->tournees->removeElement($tournee)) {
            // set the owning side to null (unless already changed)
            if ($tournee->getGuide() === $this) {
                $tournee->setGuide(null);
            }
        }

        return $this;
    }
}
