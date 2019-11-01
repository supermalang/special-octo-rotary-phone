<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * 
 * @Vich\Uploadable
 * 
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $customerType;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @Vich\UploadableField(mapping="customers_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $userAccount;

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
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $idCardType;

    /**
     * @Vich\UploadableField(mapping="idcards_images", fileNameProperty="idCardProof")
     * @var File
     */
    private $idcImageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idCardProof;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idCardNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdby;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $modifiedby;

    /**
     * @ORM\Column(type="integer")
     */
    private $versionHistory=1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idCardUploadPath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCustomerType(): ?string
    {
        return $this->customerType;
    }

    public function setCustomerType(string $customerType): self
    {
        $this->customerType = $customerType;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

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

    public function getUserAccount(): ?User
    {
        return $this->userAccount;
    }

    public function setUserAccount(?User $userAccount): self
    {
        $this->userAccount = $userAccount;

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

    public function setCreatedby(User $createdby): self
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getIdCardType(): ?string
    {
        return $this->idCardType;
    }

    public function setIdCardType(?string $idCardType): self
    {
        $this->idCardType = $idCardType;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $idcImageFile
     */
    public function setIdcImageFile(?File $image = null): void
    {
        $this->idcImageFile = $image;

        /** This is a workaround to trigger the doctrine event */
        if ($image) {
            $this->modified = new \DateTime('now');
        }
    }

    public function getIdcImageFile(): ?File
    {
        return $this->idcImageFile;
    }

    public function getIdCardProof(): ?string
    {
        return $this->idCardProof;
    }

    public function setIdCardProof(?string $idCardProof): self
    {
        $this->idCardProof = $idCardProof;

        return $this;
    }

    public function getIdCardNumber(): ?string
    {
        return $this->idCardNumber;
    }

    public function setIdCardNumber(?string $idCardNumber): self
    {
        $this->idCardNumber = $idCardNumber;

        return $this;
    }

    public function getIdCardUploadPath(): ?string
    {
        return $this->idCardUploadPath;
    }

    public function setIdCardUploadPath(?string $idCardUploadPath): self
    {
        $this->idCardUploadPath = $idCardUploadPath;

        return $this;
    }
}
