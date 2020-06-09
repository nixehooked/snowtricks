<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $source;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alternatif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function setSource($source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getAlternatif(): ?string
    {
        return $this->alternatif;
    }

    public function setAlternatif(?string $alternatif): self
    {
        $this->alternatif = $alternatif;

        return $this;
    }
}
