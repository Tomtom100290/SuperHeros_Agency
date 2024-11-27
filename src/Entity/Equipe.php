<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomEquipe = null;

    #[ORM\Column(length: 255)]
    private ?string $LeaderEquipe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipe(): ?string
    {
        return $this->NomEquipe;
    }

    public function setNomEquipe(string $NomEquipe): static
    {
        $this->NomEquipe = $NomEquipe;

        return $this;
    }

    public function getLeaderEquipe(): ?string
    {
        return $this->LeaderEquipe;
    }

    public function setLeaderEquipe(string $LeaderEquipe): static
    {
        $this->LeaderEquipe = $LeaderEquipe;

        return $this;
    }
}
