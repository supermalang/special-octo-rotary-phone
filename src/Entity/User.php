<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * @ApiResource
 * @UniqueEntity(fields={"email"})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Groups({"CarModel:read","CarBrand:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"CarModel:read","CarBrand:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Country;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $idCardType;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $idCardNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idCardProof;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="driver")
     */
    private $cars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarModel", mappedBy="createdby")
     */
    private $carModels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarBrand", mappedBy="createdby")
     */
    private $carBrands;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->carModels = new ArrayCollection();
        $this->carBrands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getIdCardType(): ?string
    {
        return $this->idCardType;
    }

    public function setIdCardType(string $idCardType): self
    {
        $this->idCardType = $idCardType;

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

    public function getIdCardProof(): ?string
    {
        return $this->idCardProof;
    }

    public function setIdCardProof(?string $idCardProof): self
    {
        $this->idCardProof = $idCardProof;

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
            $car->setDriver($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getDriver() === $this) {
                $car->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CarModel[]
     */
    public function getCarModels(): Collection
    {
        return $this->carModels;
    }

    public function addCarModel(CarModel $carModel): self
    {
        if (!$this->carModels->contains($carModel)) {
            $this->carModels[] = $carModel;
            $carModel->setCreatedby($this);
        }

        return $this;
    }

    public function removeCarModel(CarModel $carModel): self
    {
        if ($this->carModels->contains($carModel)) {
            $this->carModels->removeElement($carModel);
            // set the owning side to null (unless already changed)
            if ($carModel->getCreatedby() === $this) {
                $carModel->setCreatedby(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CarBrand[]
     */
    public function getCarBrands(): Collection
    {
        return $this->carBrands;
    }

    public function addCarBrand(CarBrand $carBrand): self
    {
        if (!$this->carBrands->contains($carBrand)) {
            $this->carBrands[] = $carBrand;
            $carBrand->setCreatedby($this);
        }

        return $this;
    }

    public function removeCarBrand(CarBrand $carBrand): self
    {
        if ($this->carBrands->contains($carBrand)) {
            $this->carBrands->removeElement($carBrand);
            // set the owning side to null (unless already changed)
            if ($carBrand->getCreatedby() === $this) {
                $carBrand->setCreatedby(null);
            }
        }

        return $this;
    }
}
