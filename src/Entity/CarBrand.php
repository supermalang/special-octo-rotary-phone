<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Carbon\Carbon;

/**
 * @ApiResource(
 *      collectionOperations={"get", "post"},
 *      itemOperations={"get"={},"put"},
 *      normalizationContext={"groups"={"CarBrand:read","CarModel:read"}},
 *      denormalizationContext={"groups"={"CarBrand:write","CarModel:read"}},
 *      attributes={
 *          "pagination_items_per_page"=50
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CarBrandRepository")
 */
class CarBrand
{
    /**
     * @var integer The ID of the car brand
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"CarBrand:read"})
     */
    private $id;

    /**
     * @var string $label The label of the car brand
     * 
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="The brand label cannot be null")
     * @Assert\Length(min=2, max=100, minMessage="The label lenght cannot be less than {{limit}}", maxMessage="The label lenght cannot be greater than {{limit}}")
     * @Groups({"CarBrand:read", "CarBrand:write", "CarModel:read"})
     */
    private $label;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CarBrand:read"})
     */
    private $logo;

    /**
     * $versionHistory the version history of the data entry                                                                                `
     * 
     * @ORM\Column(type="integer")
     * @Groups({"CarBrand:read"})
     */
    private $versionHistory=0;
    
    /**
     * Cars models having the same brand
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\CarModel", mappedBy="brand")
     * @Groups({"CarBrand:read"})
     */
    private $models;

    /**
     * $created The date the data entry was created
     * 
     * @ORM\Column(type="datetime")
     * @Groups({"CarBrand:read"})
     */
    private $created;
    
    /**
     * $modified The date the data entry was last modified
     * 
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Type("datetime")
     * @Groups({"CarBrand:read"})
     */
    private $modified;
    
    /**
     * $createdby The user who created the data entry
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="carBrands")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("object")
     * @Groups({"CarBrand:read","CarBrand:write"})
     */
    private $createdby;

    /**
     * $modifiedby The user who last modified the data entry
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @Assert\Type("object")
     * @Groups({"CarBrand:read"})
     */
    private $modifiedby;

    public function __construct()
    {
        $this->models = new ArrayCollection();
        $this->created = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    /**
     * How long time ago has the CarBrand entry has been created
     * 
     * @Groups({"CarBrand:read"})
     * 
     */
    public function getCreatedAgo(): string
    {
        return Carbon::instance($this->getCreated())->diffForHumans();
    }

    /*public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }*/

    public function getModified(): ?\DateTimeInterface
    {
        return $this->modified;
    }

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
     * @return Collection|CarBrand[]
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(CarBrand $model): self
    {
        if (!$this->models->contains($model)) {
            $this->models[] = $model;
            $model->setBrand($this);
        }

        return $this;
    }

    public function removeModel(CarBrand $model): self
    {
        if ($this->models->contains($model)) {
            $this->models->removeElement($model);
            // set the owning side to null (unless already changed)
            if ($model->getBrand() === $this) {
                $model->setBrand(null);
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

    public function getModifiedby(): ?User
    {
        return $this->modifiedby;
    }

    public function setModifiedby(?User $modifiedby): self
    {
        $this->modifiedby = $modifiedby;

        return $this;
    }
}
