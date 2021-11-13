<?php

namespace App\Entity;


use App\Repository\ClassifiedAdRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassifiedAdRepository", repositoryClass=ClassifiedAdRepository::class)
 *
 */
class ClassifiedAd
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"brand"})
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     * @Groups({"garages"})
     */
    private int $id;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"brand"})
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     *
     */
    private string $reference;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     */
    private string $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     */
    private string $description;

    /**
     * @var integer
     */
    private int $minPrice;

    /**
     * @var integer
     */
    private int $maxPrice;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     */
    private int $price;

    /**
     *
     * @var integer
     */
    private int $minYear;

    /**
     *
     * @var integer
     */
    private int $maxYear;


    /**
     * @ORM\Column(type="string")
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     * @Groups ({"users-details"})
     */
    private  $year;

    /**
     *
     * @var integer
     */
    private int $maxKilometre;

    /**
     *
     * @var integer
     */
    private int $minKilometre;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     * @Groups ({"users-details"})
     */
    private int $kilometre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     * @Groups ({"users-details"})
     */
    private string $fuel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     * @Groups ({"users-details"})
     */
    private  $typeOfVehicle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     * @Groups ({"users-details"})
     */
    private string $gearbox;

    /**
     * @ORM\Column(type="string")
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     * @Groups ({"users-details"})
     */
    private $carDoors;

    /**
     * @ORM\Column(type="string")
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     * @Groups ({"users-details"})
     */
    private $places;


    /**
     * @ORM\Column(type="json")
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"users"})
     */
    private array $photos;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="classifiedAds",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private  $model;


    /**
     * @var
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private string $modelComplement;

    /**
     * @var
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private string $modelComplement2;


    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="classifiedAds",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private  $region;

    /**
     *
     * @var integer
     */
    private int $minPower;

    /**
     *
     * @var integer
     */
    private int $maxPower;

    /**
     * @ORM\Column(type="string")
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups ({"users"})
     */
    private  $power;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ClassifiedAd",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     *
     *
     */
    private  $user;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="classifiedAds",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     *
     */
    private  $garage;

    /**
     *
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups ({"users"})
     */
    private $primeEco;

    /**
     * @var
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups ({"users"})
     */
    private $topOcass;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="classifiedAds",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups ({"users"})
     * @Groups ({"countAnnonces"})
     */
    private $brand;

    /**
     * @ORM\Column(type="datetime")
     * @Groups ({"users"})
     *
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups ({"users"})
     *
     */
    private DateTimeInterface $updatedOnAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getMinPrice(): string
    {
        return $this->minPrice;
    }

    /**
     * @param string $minPrice
     */
    public function setMinPrice(string $minPrice): void
    {
        $this->minPrice = $minPrice;
    }

    /**
     * @return int
     */
    public function getMaxPrice(): int
    {
        return $this->maxPrice;
    }

    /**
     * @param int $maxPrice
     */
    public function setMaxPrice(int $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getMinYear(): int
    {
        return $this->minYear;
    }

    /**
     * @param int $minYear
     */
    public function setMinYear(int $minYear): void
    {
        $this->minYear = $minYear;
    }

    /**
     * @return int
     */
    public function getMaxYear(): int
    {
        return $this->maxYear;
    }

    /**
     * @param int $maxYear
     */
    public function setMaxYear(int $maxYear): void
    {
        $this->maxYear = $maxYear;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getKilometre(): int
    {
        return $this->kilometre;
    }

    /**
     * @param int $kilometre
     */
    public function setKilometre(int $kilometre): void
    {
        $this->kilometre = $kilometre;
    }

    /**
     * @return string
     */
    public function getFuel(): string
    {
        return $this->fuel;
    }

    /**
     * @param string $fuel
     */
    public function setFuel(string $fuel): void
    {
        $this->fuel = $fuel;
    }

    /**
     * @return string
     */
    public function getTypeOfVehicle(): string
    {
        return $this->typeOfVehicle;
    }

    /**
     * @param string $typeOfVehicle
     */
    public function setTypeOfVehicle(string $typeOfVehicle): void
    {
        $this->typeOfVehicle = $typeOfVehicle;
    }

    /**
     * @return string
     */
    public function getGearbox(): string
    {
        return $this->gearbox;
    }

    /**
     * @param string $gearbox
     */
    public function setGearbox(string $gearbox): void
    {
        $this->gearbox = $gearbox;
    }

    /**
     * @return mixed
     */
    public function getCarDoors()
    {
        return $this->carDoors;
    }

    /**
     * @param mixed $carDoors
     */
    public function setCarDoors($carDoors): void
    {
        $this->carDoors = $carDoors;
    }

    /**
     * @return mixed
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * @param mixed $places
     */
    public function setPlaces($places): void
    {
        $this->places = $places;
    }

    /**
     * @return array
     */
    public function getPhotos(): array
    {
        return $this->photos;
    }

    /**
     * @param array $photos
     */
    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getModelComplement(): string
    {
        return $this->modelComplement;
    }

    /**
     * @param mixed $modelComplement
     */
    public function setModelComplement(string $modelComplement): void
    {
        $this->modelComplement = $modelComplement;
    }

    /**
     * @return mixed
     */
    public function getModelComplement2(): string
    {
        return $this->modelComplement2;
    }

    /**
     * @param mixed $modelComplement2
     */
    public function setModelComplement2(string $modelComplement2): void
    {
        $this->modelComplement2 = $modelComplement2;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    /**
     * @return int
     */
    public function getMinPower(): int
    {
        return $this->minPower;
    }

    /**
     * @param int $minPower
     */
    public function setMinPower(int $minPower): void
    {
        $this->minPower = $minPower;
    }

    /**
     * @return int
     */
    public function getMaxPower(): int
    {
        return $this->maxPower;
    }

    /**
     * @param int $maxPower
     */
    public function setMaxPower(int $maxPower): void
    {
        $this->maxPower = $maxPower;
    }

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power): void
    {
        $this->power = $power;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getGarage()
    {
        return $this->garage;
    }

    /**
     * @param mixed $garage
     */
    public function setGarage($garage): void
    {
        $this->garage = $garage;
    }

    /**
     * @return mixed
     */
    public function getPrimeEco()
    {
        return $this->primeEco;
    }

    /**
     * @param mixed $primeEco
     */
    public function setPrimeEco($primeEco): void
    {
        $this->primeEco = $primeEco;
    }

    /**
     * @return mixed
     */
    public function getTopOcass()
    {
        return $this->topOcass;
    }

    /**
     * @param mixed $topOcass
     */
    public function setTopOcass($topOcass): void
    {
        $this->topOcass = $topOcass;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     */
    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedOnAt(): DateTimeInterface
    {
        return $this->updatedOnAt;
    }

    /**
     * @param DateTimeInterface $updatedOnAt
     */
    public function setUpdatedOnAt(DateTimeInterface $updatedOnAt): void
    {
        $this->updatedOnAt = $updatedOnAt;
    }

    /**
     * @return int
     */
    public function getMaxKilometre(): int
    {
        return $this->maxKilometre;
    }

    /**
     * @param int $maxKilometre
     */
    public function setMaxKilometre(int $maxKilometre): void
    {
        $this->maxKilometre = $maxKilometre;
    }

    /**
     * @return int
     */
    public function getMinKilometre(): int
    {
        return $this->minKilometre;
    }

    /**
     * @param int $minKilometre
     */
    public function setMinKilometre(int $minKilometre): void
    {
        $this->minKilometre = $minKilometre;
    }


}