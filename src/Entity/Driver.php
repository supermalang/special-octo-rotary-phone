<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 * @Vich\Uploadable
 * 
 */
class Driver
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $middleName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastName;

    /**
     * @Vich\UploadableField(mapping="idcards_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUploadPath;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(min = 5, max = 20, minMessage="Please provide a phone number that has at least {{ limit }} digits", maxMessage="Please provide a phone number that has {{ limit }} digits max")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Please provide a correct phone number with digits only")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $idCardNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $createdby;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $modifiedby;

    /**
     * @ORM\Column(type="integer")
     */
    private $versionHistory=1;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Reservation", mappedBy="driver", cascade={"persist", "remove"})
     */
    private $reservations;

    public function __toString(){
        return (string) $this->getFirstName().' '.$this->getMiddleName().' '.$this.getLastName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $image = null): void
    {
        $this->imageFile = $image;

        /** This is a workaround to trigger the doctrine event */
        if ($image) {
            $this->modified = new \DateTime('now');
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageUploadPath(): ?string
    {
        return $this->imageUploadPath;
    }

    public function setImageUploadPath(?string $imageUploadPath): self
    {
        $this->imageUploadPath = $imageUploadPath;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getIdCardNumber(): ?string
    {
        return $this->idCardNumber;
    }

    public function setIdCardNumber(string $idCardNumber): self
    {
        $this->idCardNumber = $idCardNumber;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getCreatedby(): ?User
    {
        return $this->createdby;
    }

    public function setCreatedby(?User $createdby): self
    {
        $this->createdby = $createdby;

        return $this;
    }

    public function getModified(): ?\DateTimeInterface
    {
        return $this->modified;
    }

    public function setModified(?\DateTimeInterface $modified): self
    {
        $this->modified = $modified;

        return $this;
    }

    public function getModifiedby(): ?User
    {
        return $this->modifiedby;
    }

    public function setModifiedby(?User $modifiedby): self
    {
        $this->modifiedby = $modifiedby;

        return $this;
    }

    public function getVersionHistory(): ?int
    {
        return $this->versionHistory;
    }

    public function setVersionHistory(int $versionHistory): self
    {
        $this->versionHistory = $versionHistory;

        return $this;
    }

    public function getReservations(): ?Reservation
    {
        return $this->reservations;
    }

    public function setReservations(Reservation $reservations): self
    {
        $this->reservations = $reservations;

        // set the owning side of the relation if necessary
        if ($this !== $reservations->getDriver()) {
            $reservations->setDriver($this);
        }

        return $this;
    }
}
