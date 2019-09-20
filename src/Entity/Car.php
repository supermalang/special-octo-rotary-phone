<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $immatriculation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CarModel", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $model;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $chassisNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfSeats;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfDoors;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="integer")
     */
    private $rentPerKm;

    /**
     * @ORM\Column(type="integer")
     */
    private $rentPerHour;

    /**
     * @ORM\Column(type="integer")
     */
    private $rentPerDay;

    /**
     * @ORM\Column(type="integer")
     */
    private $lastOdometer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $immatriculationDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $firstContractDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $catalogValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $residualValue;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $transmission;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $fuelCase;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $co2Emission;

    /**
     * @ORM\Column(type="integer")
     */
    private $horsePower;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $power;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fuelQuantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $services;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $costs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contracts;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $status;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $inavailabilityStartDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdby;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $modifiedby;

    /**
     * @ORM\Column(type="integer")
     */
    private $versionHistory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CarType", inversedBy="cars")
     */
    private $carType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cars")
     */
    private $driver;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getModel(): ?CarModel
    {
        return $this->model;
    }

    public function setModel(?CarModel $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getDriver(): ?string
    {
        return $this->driver;
    }

    public function setDriver(?string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getChassisNumber(): ?string
    {
        return $this->chassisNumber;
    }

    public function setChassisNumber(string $chassisNumber): self
    {
        $this->chassisNumber = $chassisNumber;

        return $this;
    }

    public function getNumberOfSeats(): ?int
    {
        return $this->numberOfSeats;
    }

    public function setNumberOfSeats(int $numberOfSeats): self
    {
        $this->numberOfSeats = $numberOfSeats;

        return $this;
    }

    public function getNumberOfDoors(): ?int
    {
        return $this->numberOfDoors;
    }

    public function setNumberOfDoors(int $numberOfDoors): self
    {
        $this->numberOfDoors = $numberOfDoors;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getCarType(): ?string
    {
        return $this->carType;
    }

    public function setCarType(?string $carType): self
    {
        $this->carType = $carType;

        return $this;
    }

    public function getRentPerKm(): ?int
    {
        return $this->rentPerKm;
    }

    public function setRentPerKm(int $rentPerKm): self
    {
        $this->rentPerKm = $rentPerKm;

        return $this;
    }

    public function getRentPerHour(): ?int
    {
        return $this->rentPerHour;
    }

    public function setRentPerHour(int $rentPerHour): self
    {
        $this->rentPerHour = $rentPerHour;

        return $this;
    }

    public function getRentPerDay(): ?int
    {
        return $this->rentPerDay;
    }

    public function setRentPerDay(int $rentPerDay): self
    {
        $this->rentPerDay = $rentPerDay;

        return $this;
    }

    public function getLastOdometer(): ?int
    {
        return $this->lastOdometer;
    }

    public function setLastOdometer(int $lastOdometer): self
    {
        $this->lastOdometer = $lastOdometer;

        return $this;
    }

    public function getImmatriculationDate(): ?\DateTimeInterface
    {
        return $this->immatriculationDate;
    }

    public function setImmatriculationDate(\DateTimeInterface $immatriculationDate): self
    {
        $this->immatriculationDate = $immatriculationDate;

        return $this;
    }

    public function getFirstContractDate(): ?\DateTimeInterface
    {
        return $this->firstContractDate;
    }

    public function setFirstContractDate(?\DateTimeInterface $firstContractDate): self
    {
        $this->firstContractDate = $firstContractDate;

        return $this;
    }

    public function getCatalogValue(): ?int
    {
        return $this->catalogValue;
    }

    public function setCatalogValue(?int $catalogValue): self
    {
        $this->catalogValue = $catalogValue;

        return $this;
    }

    public function getResidualValue(): ?int
    {
        return $this->residualValue;
    }

    public function setResidualValue(?int $residualValue): self
    {
        $this->residualValue = $residualValue;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getFuelCase(): ?string
    {
        return $this->fuelCase;
    }

    public function setFuelCase(string $fuelCase): self
    {
        $this->fuelCase = $fuelCase;

        return $this;
    }

    public function getCo2Emission(): ?float
    {
        return $this->co2Emission;
    }

    public function setCo2Emission(?float $co2Emission): self
    {
        $this->co2Emission = $co2Emission;

        return $this;
    }

    public function getHorsePower(): ?int
    {
        return $this->horsePower;
    }

    public function setHorsePower(int $horsePower): self
    {
        $this->horsePower = $horsePower;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(?int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getFuelQuantity(): ?int
    {
        return $this->fuelQuantity;
    }

    public function setFuelQuantity(?int $fuelQuantity): self
    {
        $this->fuelQuantity = $fuelQuantity;

        return $this;
    }

    public function getServices(): ?string
    {
        return $this->services;
    }

    public function setServices(?string $services): self
    {
        $this->services = $services;

        return $this;
    }

    public function getCosts(): ?string
    {
        return $this->costs;
    }

    public function setCosts(?string $costs): self
    {
        $this->costs = $costs;

        return $this;
    }

    public function getContract(): ?string
    {
        return $this->contract;
    }

    public function setContract(?string $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getInavailabilityStartDate(): ?\DateTimeInterface
    {
        return $this->inavailabilityStartDate;
    }

    public function setInavailabilityStartDate(?\DateTimeInterface $inavailabilityStartDate): self
    {
        $this->inavailabilityStartDate = $inavailabilityStartDate;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

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

    public function getModified(): ?\DateTimeInterface
    {
        return $this->modified;
    }

    public function setModified(?\DateTimeInterface $modified): self
    {
        $this->modified = $modified;

        return $this;
    }

    public function getCreatedby(): ?string
    {
        return $this->createdby;
    }

    public function setCreatedby(?string $createdby): self
    {
        $this->createdby = $createdby;

        return $this;
    }

    public function getModifiedby(): ?string
    {
        return $this->modifiedby;
    }

    public function setModifiedby(?string $modifiedby): self
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

    public function getContracts(): ?string
    {
        return $this->contracts;
    }

    public function setContracts(?string $contracts): self
    {
        $this->contracts = $contracts;

        return $this;
    }
}
