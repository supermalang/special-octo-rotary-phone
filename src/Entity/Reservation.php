<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
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
    private $pickupLocation;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dropoffLocation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $pickupDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dropoffDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Car", inversedBy="reservations", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservedCar;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Driver", inversedBy="reservations", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $driver;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numberOfDays;

    /**
     * @ORM\Column(type="smallint")
     */
    private $dailyRate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $discount;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $discountType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
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
     * @ORM\Column(type="smallint")
     */
    private $versionHistory=1;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ReservationOption")
     */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPickupLocation(): ?string
    {
        return $this->pickupLocation;
    }

    public function setPickupLocation(string $pickupLocation): self
    {
        $this->pickupLocation = $pickupLocation;

        return $this;
    }

    public function getDropoffLocation(): ?string
    {
        return $this->dropoffLocation;
    }

    public function setDropoffLocation(string $dropoffLocation): self
    {
        $this->dropoffLocation = $dropoffLocation;

        return $this;
    }

    public function getPickupDate(): ?\DateTimeInterface
    {
        return $this->pickupDate;
    }

    public function setPickupDate(\DateTimeInterface $pickupDate): self
    {
        $this->pickupDate = $pickupDate;

        return $this;
    }

    public function getDropoffDate(): ?\DateTimeInterface
    {
        return $this->dropoffDate;
    }

    public function setDropoffDate(\DateTimeInterface $dropoffDate): self
    {
        $this->dropoffDate = $dropoffDate;

        return $this;
    }

    public function getReservedCar(): ?Car
    {
        return $this->reservedCar;
    }

    public function setReservedCar(Car $reservedCar): self
    {
        $this->reservedCar = $reservedCar;

        return $this;
    }

    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(Driver $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getNumberOfDays(): ?int
    {
        return $this->numberOfDays;
    }

    public function setNumberOfDays(int $numberOfDays): self
    {
        $this->numberOfDays = $numberOfDays;

        return $this;
    }

    public function getDailyRate(): ?int
    {
        return $this->dailyRate;
    }

    public function setDailyRate(int $dailyRate): self
    {
        $this->dailyRate = $dailyRate;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    public function setDiscountType(?string $discountType): self
    {
        $this->discountType = $discountType;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

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

    /**
     * @return Collection|ReservationOption[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(ReservationOption $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function removeOption(ReservationOption $option): self
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
        }

        return $this;
    }
}
