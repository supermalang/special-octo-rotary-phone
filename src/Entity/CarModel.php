<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ApiResource(
 *      collectionOperations={
 *           "post",
 *           "get"={"security"="is_granted('ROLE_ADMIN')"}
 * },
 *      itemOperations={"get"={},"put"},
 *      normalizationContext={"groups"={"CarModel:read"}},
 *      denormalizationContext={"groups"={"CarModel:write"}},
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CarModelRepository")
 * 
 * @Vich\Uploadable
 * 
 */
class CarModel
{
    /**
     * The id of the car model entry
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"CarModel:read"})
     */
    private $id;

    /**
     * The constructor of the car
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\CarBrand", inversedBy="models")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"CarModel:read","CarModel:write", "Car:read"})
     * @Assert\NotBlank(message="The car brand cannot be null")
     * @Assert\Type("object")
     */
    private $brand;

    /**
     * $label the label of the car model
     * 
     * @ORM\Column(type="string", length=100)
     * @Groups({"CarModel:read","CarModel:write","Car:read"})
     * @Assert\NotBlank(message="The label cannot be null")
     * @Assert\Type("string")
     */
    private $label;

    /**
     * $year the year the model was published
     * 
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"CarModel:read","CarModel:write"})
     * @Assert\Range(min=1950, max=2050, minMessage="The model's year cannot be before {{ limit }}", maxMessage="The model's year cannot be after {{ limit }}")
     * @Assert\Type("integer")
     */
    private $year;

    /**
     * $createdby the user who created the data entry
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="carModels")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"CarModel:read","CarModel:write"})
     */
    private $createdby;

    /**
     * $modifiedby the user who last modified the data entry
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @Groups({"CarModel:read"})
     * @Assert\Type("object")
     */
    private $modifiedby;

    /**
     * $created the date when the data entry was created
     * 
     * @ORM\Column(type="datetime")
     * @Groups({"CarModel:read"})
     */
    private $created;

    /**
     * $modified the date when the data entry was last modified
     * 
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"CarModel:read"})
     * @Assert\Type("datetime")
     */
    private $modified;

    /**
     * $versionHistory the version history of the data entry modifications
     * 
     * @ORM\Column(type="integer")
     * @Groups({"CarModel:read"})
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    private $versionHistory=1;

    /**
     * $cars The list of cars of the same model
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="model")
     * @Groups({"CarModel:read"})
     */
    private $cars;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CarModel:read"})
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="car_model_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * $imageUploadPath Full path of the uploaded image. To be used in the API
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CarModel:read"})
     */
    private $imageUploadPath;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function __toString(){
        return (string) $this->getFullModelName();
    }

    /** Returns the name of the model with the Manufacturer included */
    public function getFullModelName(){
        return $this->getBrand()->getLabel()." ".$this->getLabel();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?CarBrand
    {
        return $this->brand;
    }

    public function setBrand(?CarBrand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    /**
     * How long time ago has the CarModel entry has been created
     * 
     * @Groups({"CarModel:read"})
     */
    public function getCreatedAgo(): string
    {
        return Carbon::instance($this->getCreated())->diffForHumans();
    }

    public function getModified(): ?\DateTimeInterface
    {
        return $this->modified;
    }

    /**
     * How long time ago has the CarModel entry been modified
     * 
     * @Groups({"CarModel:read"})
     */
    /*public function getModifiedAgo(): string
    {
        return Carbon::instance($this->getModified())->diffForHumans();
    }*/

    public function setModified(?\DateTimeInterface $modified): self
    {
        $this->modified = $modified;

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

    /**
     * @return Collection|Car[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setModel($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getModel() === $this) {
                $car->setModel(null);
            }
        }

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

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

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
}
