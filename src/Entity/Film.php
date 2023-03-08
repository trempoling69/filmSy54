<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $nom = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $pitch = null;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: Plan::class)]
    private Collection $Plans;

    public function __construct()
    {
        $this->Plans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPitch(): ?string
    {
        return $this->pitch;
    }

    public function setPitch(?string $pitch): self
    {
        $this->pitch = $pitch;

        return $this;
    }

    /**
     * @return Collection<int, Plan>
     */
    public function getPlans(): Collection
    {
        return $this->Plans;
    }

    public function addPlan(Plan $plan): self
    {
        if (!$this->Plans->contains($plan)) {
            $this->Plans->add($plan);
            $plan->setFilm($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->Plans->removeElement($plan)) {
            // set the owning side to null (unless already changed)
            if ($plan->getFilm() === $this) {
                $plan->setFilm(null);
            }
        }

        return $this;
    }
}
