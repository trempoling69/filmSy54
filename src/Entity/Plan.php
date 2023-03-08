<?php

namespace App\Entity;

use App\Repository\PlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlanRepository::class)]
class Plan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Assert\Regex(pattern:'/^pl_[0-9]{3}$/', match: true, message:'Une référence de la forme pl_000')]
    private ?string $reference = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min:0, max:100, minMessage:'Durée min {{min}} secondes', maxMessage:'Durée max {{max}} secondes')]
    private ?int $duree = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $echelle = null;

    #[ORM\Column(length:1000, nullable:true)]
    private ?string $dialogues = null;

    #[ORM\ManyToOne(inversedBy: 'plans')]
    #[Assert\NotBlank]
    private ?Effet $effet = null;

    #[ORM\ManyToMany(targetEntity: Artefact::class, inversedBy: 'plans')]
    private Collection $artefacts;

    #[ORM\ManyToOne(inversedBy: 'Plans')]
    private ?Film $film = null;

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
    public function __toString()
    {
        return $this->reference;
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

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): self
    {
        $this->film = $film;

        return $this;
    }
}