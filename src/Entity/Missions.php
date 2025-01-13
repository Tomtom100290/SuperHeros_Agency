<?php

namespace App\Entity;

use App\Repository\MissionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PHPUnit\TextUI\XmlConfiguration\Logging\Text;

#[ORM\Entity(repositoryClass: MissionsRepository::class)]
class Missions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomMission = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $DescriptionMission = null;

    #[ORM\Column(type: Types::STRING)]
    private array $PouvoirsRequis = [];

    #[ORM\Column(type: Types::STRING)]
    private array $VillesMission = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMission(): ?string
    {
        return $this->NomMission;
    }

    public function setNomMission(string $NomMission): static
    {
        $this->NomMission = $NomMission;

        return $this;
    }

    public function getDescriptionMission(): ?string
    {
        return $this->DescriptionMission;
    }

    public function setDescriptionMission(string $DescriptionMission): static
    {
        $this->DescriptionMission = $DescriptionMission;

        return $this;
    }

    public function getPouvoirsRequis(): Text
    {
        return $this->PouvoirsRequis;
    }

    public function setPouvoirsRequis(string $PouvoirsRequis): static
    {
        $this->PouvoirsRequis = $PouvoirsRequis;

        return $this;
    }

    public function getVillesMission(): array
    {
        return $this->VillesMission;
    }

    public function setVillesMission(string $VillesMission): static
    {
        $this->VillesMission = $VillesMission;

        return $this;
    }
}
