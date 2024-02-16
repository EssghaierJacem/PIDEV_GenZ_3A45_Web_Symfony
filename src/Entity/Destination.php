<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $attractions = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $accomodation = null;

    #[ORM\Column(length: 255)]
    private ?string $devise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $multimedia = null;

    #[ORM\Column(nullable: true)]
    private ?bool $accessibilite = null;

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
}
