<?php

namespace App\Entity;

use App\Repository\PlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanRepository::class)]
class Plan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $reference = null;

    #[ORM\Column(nullable: true)]
    private ?int $duree = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $echelle = null;

    #[ORM\Column(length:1000, nullable:true)]
    private ?string $dialogues = null;

    #[ORM\ManyToOne(inversedBy: 'plans')]
    private ?Effet $effet = null;

    #[ORM\ManyToMany(targetEntity: Artefact::class, inversedBy: 'plans')]
    private Collection $artefacts;

    public function __construct()
    {
        $this->artefacts = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getEchelle(): ?string
    {
        return $this->echelle;
    }

    public function setEchelle(?string $echelle): self
    {
        $this->echelle = $echelle;

        return $this;
    }

    public function getDialogues(): ?string
    {
        return $this->dialogues;
    }

    public function setDialogues(?string $dialogues): self
    {
        $this->dialogues = $dialogues;

        return $this;
    }

    public function getEffet(): ?Effet
    {
        return $this->effet;
    }

    public function setEffet(?Effet $effet): self
    {
        $this->effet = $effet;

        return $this;
    }

    /**
     * @return Collection<int, Artefact>
     */
    public function getArtefacts(): Collection
    {
        return $this->artefacts;
    }

    public function addArtefact(Artefact $artefact): self
    {
        if (!$this->artefacts->contains($artefact)) {
            $this->artefacts->add($artefact);
        }

        return $this;
    }

    public function removeArtefact(Artefact $artefact): self
    {
        $this->artefacts->removeElement($artefact);

        return $this;
    }
}