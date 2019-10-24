<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaObjectRepository")
 */
class MediaObject
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
    private $contentUrl;

    /**
     * @ORM\Column(type="blob")
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filePath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setContentUrl(string $contentUrl): self
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }
}
