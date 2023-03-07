<?php

namespace App\Entity;

use App\Repository\PlanRepository;
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
}