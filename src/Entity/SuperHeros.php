<?php

namespace App\Entity;

use App\Repository\SuperHerosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: SuperHerosRepository::class)]
#[Vich\Uploadable]
class SuperHeros
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;
    /*
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }
*/
    #[Vich\UploadableField(mapping: 'heros_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    /* #[ORM\Column(nullable: true)]
    private ?string $imageName = null;*/

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AlterEgo = null;

    #[ORM\Column]
    private ?bool $Disponible = null;

    #[ORM\Column]
    private ?int $Energie = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Biographie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ImageName = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageName(): ?string
    {
        return $this->ImageName;
    }

    public function setImageName(?string $imageName): void
    {
        $this->ImageName = $imageName;
    }

    public function getAlterEgo(): ?string
    {
        return $this->AlterEgo;
    }

    public function setAlterEgo(?string $AlterEgo): static
    {
        $this->AlterEgo = $AlterEgo;

        return $this;
    }

    public function isDisponible(): ?bool
    {
        return $this->Disponible;
    }

    public function setDisponible(bool $Disponible): static
    {
        $this->Disponible = $Disponible;

        return $this;
    }

    public function getEnergie(): ?int
    {
        return $this->Energie;
    }

    public function setEnergie(int $Energie): static
    {
        $this->Energie = $Energie;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->Biographie;
    }

    public function setBiographie(string $Biographie): static
    {
        $this->Biographie = $Biographie;

        return $this;
    }
    /*
    public function getImageName(): ?string
    {
        return $this->ImageName;
    }

    public function setImageName(?string $ImageName): static
    {
        $this->ImageName = $ImageName;

        return $this;
    }
*/
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
