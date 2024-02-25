<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: DestinationRepository::class)]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Country]
    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Length(min:4, minMessage: 'Minmum 4 caractère')]
    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[Assert\Length(
        min: 15,
        max: 255,
        minMessage: 'Minimum 15 caractères',
        maxMessage: 'Maximum 255 caractères',
    )]
    #[Assert\NotBlank(message:"Il faut décrire ce pays!")]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Minimum 5 caractères',
        maxMessage: 'Maximum 50 caractères',
    )]
    #[Assert\NotBlank(message: "Veulliez mentioner quelques attractions!")]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $attractions = null;

    #[Assert\Length(
        min: 5,
        max: 30,
        minMessage: 'Minimum 5 caractères',
        maxMessage: 'Maximum 30 caractères',
    )]
    #[Assert\NotBlank(message: "Veulliez entrer une accomodation!")]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $accomodation = null;

    #[Assert\Currency(message: 'Il faut attribuer une vraie devise')]
    #[ORM\Column(length: 255)]
    private ?string $devise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $multimedia = null;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide")]
    #[Assert\Type(type: 'bool', message: "La valeur doit être de type booléen")]
    private ?bool $accessibilite = null;
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Minimum 5 caractères',
        maxMessage: 'Maximum 50 caractères',
    )]
    #[Assert\NotBlank(message: "Veulliez mentionner quelques repas!")]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cuisine_locale = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'destination')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'destination', targetEntity: Vol::class)]
    private Collection $vol;

    #[ORM\OneToMany(mappedBy: 'destination', targetEntity: Tournee::class)]
    private Collection $tournee;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->vol = new ArrayCollection();
        $this->tournee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

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

    public function getAttractions(): ?string
    {
        return $this->attractions;
    }

    public function setAttractions(?string $attractions): static
    {
        $this->attractions = $attractions;

        return $this;
    }

    public function getAccomodation(): ?string
    {
        return $this->accomodation;
    }

    public function setAccomodation(?string $accomodation): static
    {
        $this->accomodation = $accomodation;

        return $this;
    }

    public function getDevise(): ?string
    {
        return $this->devise;
    }

    public function setDevise(string $devise): static
    {
        $this->devise = $devise;

        return $this;
    }

    public function getMultimedia(): ?string
    {
        return $this->multimedia;
    }

    public function setMultimedia(?string $multimedia): static
    {
        $this->multimedia = $multimedia;

        return $this;
    }

    public function isAccessibilite(): ?bool
    {
        return $this->accessibilite;
    }

    public function setAccessibilite(?bool $accessibilite): static
    {
        $this->accessibilite = $accessibilite;

        return $this;
    }

    public function getCuisineLocale(): ?string
    {
        return $this->cuisine_locale;
    }

    public function setCuisineLocale(?string $cuisine_locale): static
    {
        $this->cuisine_locale = $cuisine_locale;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addDestination($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeDestination($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Vol>
     */
    public function getVol(): Collection
    {
        return $this->vol;
    }

    public function addVol(Vol $vol): static
    {
        if (!$this->vol->contains($vol)) {
            $this->vol->add($vol);
            $vol->setDestination($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): static
    {
        if ($this->vol->removeElement($vol)) {
            // set the owning side to null (unless already changed)
            if ($vol->getDestination() === $this) {
                $vol->setDestination(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tournee>
     */
    public function getTournee(): Collection
    {
        return $this->tournee;
    }

    public function addTournee(Tournee $tournee): static
    {
        if (!$this->tournee->contains($tournee)) {
            $this->tournee->add($tournee);
            $tournee->setDestination($this);
        }

        return $this;
    }

    public function removeTournee(Tournee $tournee): static
    {
        if ($this->tournee->removeElement($tournee)) {
            // set the owning side to null (unless already changed)
            if ($tournee->getDestination() === $this) {
                $tournee->setDestination(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getPays();
    }
}
