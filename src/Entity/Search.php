<?php

namespace App\Entity;

use App\Repository\SearchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SearchRepository::class)
 */
class Search
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $carDoors = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $fuel = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $gearbox = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $models = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $places = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $regions = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $typeOfVehicle = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $kilometrage = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minKilometre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxKilometre;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $powers = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minPower;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxPower;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $years = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxYear;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $prices = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxPrice;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getCarDoors(): array
    {
        return $this->carDoors;
    }

    /**
     * @param array $carDoors
     * @return Search
     */
    public function setCarDoors(array $carDoors): Search
    {
        $this->carDoors = $carDoors;
        return $this;
    }

    /**
     * @return array
     */
    public function getFuel(): array
    {
        return $this->fuel;
    }

    /**
     * @param array $fuel
     * @return Search
     */
    public function setFuel(array $fuel): Search
    {
        $this->fuel = $fuel;
        return $this;
    }

    /**
     * @return array
     */
    public function getGearbox(): array
    {
        return $this->gearbox;
    }

    /**
     * @param array $gearbox
     * @return Search
     */
    public function setGearbox(array $gearbox): Search
    {
        $this->gearbox = $gearbox;
        return $this;
    }

    /**
     * @return array
     */
    public function getModels(): array
    {
        return $this->models;
    }

    /**
     * @param array $models
     * @return Search
     */
    public function setModels(array $models): Search
    {
        $this->models = $models;
        return $this;
    }

    /**
     * @return array
     */
    public function getPlaces(): array
    {
        return $this->places;
    }

    /**
     * @param array $places
     * @return Search
     */
    public function setPlaces(array $places): Search
    {
        $this->places = $places;
        return $this;
    }

    /**
     * @return array
     */
    public function getRegions(): array
    {
        return $this->regions;
    }

    /**
     * @param array $regions
     * @return Search
     */
    public function setRegions(array $regions): Search
    {
        $this->regions = $regions;
        return $this;
    }

    /**
     * @return array
     */
    public function getTypeOfVehicle(): array
    {
        return $this->typeOfVehicle;
    }

    /**
     * @param array $typeOfVehicle
     * @return Search
     */
    public function setTypeOfVehicle(array $typeOfVehicle): Search
    {
        $this->typeOfVehicle = $typeOfVehicle;
        return $this;
    }

    /**
     * @return array
     */
    public function getKilometrage(): array
    {
        return $this->kilometrage;
    }

    /**
     * @param array $kilometrage
     * @return Search
     */
    public function setKilometrage(array $kilometrage): Search
    {
        $this->kilometrage = $kilometrage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinKilometre()
    {
        return $this->minKilometre;
    }

    /**
     * @param mixed $minKilometre
     * @return Search
     */
    public function setMinKilometre($minKilometre)
    {
        $this->minKilometre = $minKilometre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxKilometre()
    {
        return $this->maxKilometre;
    }

    /**
     * @param mixed $maxKilometre
     * @return Search
     */
    public function setMaxKilometre($maxKilometre)
    {
        $this->maxKilometre = $maxKilometre;
        return $this;
    }

    public function getPowers(): ?array
    {
        return $this->powers;
    }

    public function setPowers(?array $powers): self
    {
        $this->powers = $powers;

        return $this;
    }

    public function getMinPower(): ?int
    {
        return $this->minPower;
    }

    public function setMinPower(?int $minPower): self
    {
        $this->minPower = $minPower;

        return $this;
    }

    public function getMaxPower(): ?int
    {
        return $this->maxPower;
    }

    public function setMaxPower(?int $maxPower): self
    {
        $this->maxPower = $maxPower;

        return $this;
    }

    public function getYears(): ?array
    {
        return $this->years;
    }

    public function setYears(?array $years): self
    {
        $this->years = $years;

        return $this;
    }

    public function getMinYear(): ?int
    {
        return $this->minYear;
    }

    public function setMinYear(?int $minYear): self
    {
        $this->minYear = $minYear;

        return $this;
    }

    public function getMaxYear(): ?int
    {
        return $this->maxYear;
    }

    public function setMaxYear(?int $maxYear): self
    {
        $this->maxYear = $maxYear;

        return $this;
    }

    public function getPrices(): ?array
    {
        return $this->prices;
    }

    public function setPrices(?array $prices): self
    {
        $this->prices = $prices;

        return $this;
    }

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(?int $minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }


}
