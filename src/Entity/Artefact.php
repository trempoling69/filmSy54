<?php

namespace App\Entity;

use App\Repository\ArtefactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtefactRepository::class)]
class Artefact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 512, nullable: true)]
    private ?string $details = null;

    #[ORM\ManyToOne(fetch: "EAGER")]
    private ?TypeArtefact $typeArtefact = null;

    #[ORM\ManyToMany(targetEntity: Plan::class, mappedBy: 'artefacts')]
    private Collection $plans;

    public function __construct()
    {
        $this->plans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getTypeArtefact(): ?TypeArtefact
    {
        return $this->typeArtefact;
    }

    public function __toString()
    {
        return $this->nom;
    }
    public function setTypeArtefact(?TypeArtefact $typeArtefact): self
    {
        $this->typeArtefact = $typeArtefact;

        return $this;
    }

    /**
     * @return Collection<int, Plan>
     */
    public function getPlans(): Collection
    {
        return $this->plans;
    }

    public function addPlan(Plan $plan): self
    {
        if (!$this->plans->contains($plan)) {
            $this->plans->add($plan);
            $plan->addArtefact($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->plans->removeElement($plan)) {
            $plan->removeArtefact($this);
        }

        return $this;
    }
}