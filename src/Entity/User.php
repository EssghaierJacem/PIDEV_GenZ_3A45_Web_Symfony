<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Length(min:4, minMessage: 'Minmum 4 caractère')]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Length(min:4, minMessage: 'Minmum 4 caractère')]
    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Length(min:4, minMessage: 'Minmum 4 caractère')]
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Length(max:8, maxMessage: 'max 8 caractère')]
    #[ORM\Column]
    private ?int $cin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[Assert\NotBlank(message:"Ce champ ne peut pas etre vide")]
    #[Assert\Length(max:8, maxMessage: 'max 8 caractère')]
    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Avis::class)]
    private Collection $avis;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Hebergement::class)]
    private Collection $hebergement;

    #[ORM\ManyToMany(targetEntity: Destination::class, inversedBy: 'users')]
    private Collection $destination;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Participation::class)]
    private Collection $participation;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Reservation::class)]
    private Collection $reservation;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
        $this->hebergement = new ArrayCollection();
        $this->destination = new ArrayCollection();
        $this->participation = new ArrayCollection();
        $this->reservation = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): static
    {
        $this->cin = $cin;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setUser($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getUser() === $this) {
                $avi->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hebergement>
     */
    public function getHebergement(): Collection
    {
        return $this->hebergement;
    }

    public function addHebergement(Hebergement $hebergement): static
    {
        if (!$this->hebergement->contains($hebergement)) {
            $this->hebergement->add($hebergement);
            $hebergement->setUser($this);
        }

        return $this;
    }

    public function removeHebergement(Hebergement $hebergement): static
    {
        if ($this->hebergement->removeElement($hebergement)) {
            // set the owning side to null (unless already changed)
            if ($hebergement->getUser() === $this) {
                $hebergement->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Destination>
     */
    public function getDestination(): Collection
    {
        return $this->destination;
    }

    public function addDestination(Destination $destination): static
    {
        if (!$this->destination->contains($destination)) {
            $this->destination->add($destination);
        }

        return $this;
    }

    public function removeDestination(Destination $destination): static
    {
        $this->destination->removeElement($destination);

        return $this;
    }

    /**
     * @return Collection<int, Participation>
     */
    public function getParticipation(): Collection
    {
        return $this->participation;
    }

    public function addParticipation(Participation $participation): static
    {
        if (!$this->participation->contains($participation)) {
            $this->participation->add($participation);
            $participation->setUser($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): static
    {
        if ($this->participation->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getUser() === $this) {
                $participation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation->add($reservation);
            $reservation->setUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
            }
        }

        return $this;
    }
    
}
