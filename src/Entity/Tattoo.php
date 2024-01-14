<?php

namespace App\Entity;

use App\Repository\TattooRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: TattooRepository::class)]
#[Vich\Uploadable]
class Tattoo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $realisationTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\Column(type: 'string', length : 255, nullable: true)]
    private ?string $poster = null;

    #[Vich\UploadableField(mapping: 'poster_file', fileNameProperty: 'poster')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $posterFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $madeOn = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRealisationTime(): ?int
    {
        return $this->realisationTime;
    }

    public function setRealisationTime(int $realisationTime): static
    {
        $this->realisationTime = $realisationTime;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $image): static
    {
        $this->poster = $image;

        return $this;
    }

    public function getMadeOn(): ?\DateTimeInterface
    {
        return $this->madeOn;
    }

    public function setMadeOn(?\DateTimeInterface $madeOn): static
    {
        $this->madeOn = $madeOn;

        return $this;
    }

    public function setPosterFile(File $image = null): Tattoo
    {
        $this->posterFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DatetimeInterface $updatedAt): Tattoo
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
