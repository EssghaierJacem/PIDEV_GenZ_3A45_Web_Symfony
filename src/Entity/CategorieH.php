<?php

namespace App\Entity;

use App\Repository\CategorieHRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieHRepository::class)]
class CategorieH
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Type cannot be blank')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Type must be at least {{ limit }} characters long',
        maxMessage: 'Type cannot be longer than {{ limit }} characters',
    )]
    private ?string $Type = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Description must be at least {{ limit }} characters long',
        maxMessage: 'Description cannot be longer than {{ limit }} characters',
    )]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'categorieH', targetEntity: Hebergement::class)]
    private Collection $hebergements;

    public function __construct()
    {
        $this->hebergements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): static
    {
        $this->Type = $Type;

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

    /**
     * @return Collection<int, Hebergement>
     */
    public function getHebergements(): Collection
    {
        return $this->hebergements;
    }

    public function addHebergement(Hebergement $hebergement): static
    {
        if (!$this->hebergements->contains($hebergement)) {
            $this->hebergements->add($hebergement);
            $hebergement->setCategorieH($this);
        }

        return $this;
    }

    public function removeHebergement(Hebergement $hebergement): static
    {
        if ($this->hebergements->removeElement($hebergement)) {
            // set the owning side to null (unless already changed)
            if ($hebergement->getCategorieH() === $this) {
                $hebergement->setCategorieH(null);
            }
        }

        return $this;
    }
}
