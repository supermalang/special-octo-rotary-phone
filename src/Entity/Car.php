<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ApiResource(
 *      collectionOperations={"get", "post"},
 *      itemOperations={"get"={},"put"},
 *      attributes={ "pagination_items_per_page"=10 },
 *      normalizationContext={"groups"={"Car:read"}},
 *      denormalizationContext={"groups"={"Car:write"}}
 * )
 * 
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @var integer the ID of the car
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"Car:read"})
     */
    private $id;

    /**
     * @var string the immatriculation number of the car
     * @ORM\Column(type="string", length=8)
     * @Groups({"Car:read", "Car:write"})
     */
    private $immatriculation;
    
    /**
     * @var object the car model
     * @ORM\ManyToOne(targetEntity="App\Entity\CarModel", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"Car:read", "Car:write"})
     */
    private $model;
    
    
    /**
     * @var string the car location
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $location;
    
    /**
     * @var string the chassis number 
     * @ORM\Column(type="string", length=50)
     * @Groups({"Car:read", "Car:write"})
     */
    private $chassisNumber;
    
    /**
     * @var integer The number of seats the car have
     * @ORM\Column(type="integer")
     * @Groups({"Car:read", "Car:write"})
     */
    private $numberOfSeats;
    
    /**
     * @var integer The number of doors the car have
     * @ORM\Column(type="integer")
     * @Groups({"Car:read", "Car:write"})
     */
    private $numberOfDoors;
    
    /**
     * @var string The color of the car
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $color;
    
    /**
     * @var integer The prince of the rent per KM (if specified)
     * @ORM\Column(type="integer")
     * @Groups({"Car:read", "Car:write"})
     */
    private $rentPerKm=0;
    
    /**
     * @var integer The price of the rent per Hour (if specified)
     * @ORM\Column(type="integer")
     * @Groups({"Car:read", "Car:write"})
     */
    private $rentPerHour=0;
    
    /**
     * @var integer The price of the rent per day (if specified)
     * @ORM\Column(type="integer")
     * @Groups({"Car:read", "Car:write"})
     */
    private $rentPerDay;
    
    /**
     * @var integer The number of KM the car has made (To be updated regularly)
     * @ORM\Column(type="integer")
     * @Groups({"Car:read", "Car:write"})
     */
    private $lastOdometer;
    
    /**
     * @var datetime The immatriculation date
     * @ORM\Column(type="datetime")
     * @Groups({"Car:read", "Car:write"})
     */
    private $immatriculationDate;
    
    /**
     * @var datetime The date of the first contract
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $firstContractDate;
    
    /**
     * @var integer The initial value of the car
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $catalogValue;
    
    /**
     * @var The actual value of the car
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $residualValue;
    
    /**
     * @var string The type of transmission of the car
     * @ORM\Column(type="string", length=20)
     * @Groups({"Car:read", "Car:write"})
     */
    private $transmission;
    
    /**
     * @var string The type of fuel the car take
     * @ORM\Column(type="string", length=20)
     * @Groups({"Car:read", "Car:write"})
     */
    private $fuelCase;
    
    /**
     * @var float The CO2 emission
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $co2Emission;
    
    /**
     * @var integer The horsePower of the car
     * @ORM\Column(type="integer")
     * @Groups({"Car:read", "Car:write"})
     */
    private $horsePower;
    
    /**
     * @var integer Power
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $power;
    
    /** 
     * @var integer The remaining fuel quantity in the car (in liters)
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $fuelQuantity;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $services;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $costs;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $contracts;
    
    /**
     * @var string The status of the car (available, booked, breakdown)
     * @ORM\Column(type="string", length=20)
     * @Groups({"Car:read", "Car:write"})
     */
    private $status;
    
    /**
     * @var datetime The date from which the car will be unavailable
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $inavailabilityStartDate;
    
    /**
     * @var datetime The date until which the car will be unavailable
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $inavailabilityEndDate;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Car:read", "Car:write"})
     */
    private $tags;
    
    /**
     * @var datetime The date the entry was created in the system
     * @ORM\Column(type="datetime")
     * @Groups({"Car:read"})
     */
    private $created;
    
    /**
     * @var datetime The date the entry was last modified in the system
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"Car:read"})
     */
    private $modified;
    
    /**
     * @var integer The version history of the car
     * @ORM\Column(type="integer")
     * @Groups({"Car:read"})
     */
    private $versionHistory=1;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\CarType", inversedBy="cars")
     * @Groups({"Car:read","Car:write"})
     */
    private $carType;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"Car:read","Car:write"})
     */
    private $createdBy;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @Groups({"Car:read","Car:write"})
     */
    private $modifiedby;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="carsAssigned")
     * @Groups({"Car:read","Car:write"})
     */
    private $driver;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Reservation", mappedBy="reservedCar", cascade={"persist", "remove"})
     */
    private $reservations;

    public function __construct()
    {
        $this->immatriculationDate = new \DateTimeImmutable();
        $this->status = 'Available';
    }

    public function __toString(){
        return (string) $this->getModel().' '.$this->getImmatriculation();
    }

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

    public function getDriver(): ?User
    {
        return $this->driver;
    }

    public function setDriver(?User $driver): self
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

    public function getInavailabilityEndDate(): ?\DateTimeInterface
    {
        return $this->inavailabilityEndDate;
    }

    public function setInavailabilityEndDate(?\DateTimeInterface $inavailabilityEndDate): self
    {
        $this->inavailabilityStartDate = $inavailabilityEndDate;

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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

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

    public function getContracts(): ?string
    {
        return $this->contracts;
    }

    public function setContracts(?string $contracts): self
    {
        $this->contracts = $contracts;

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
        if ($this !== $reservations->getReservedCar()) {
            $reservations->setReservedCar($this);
        }

        return $this;
    }
}
