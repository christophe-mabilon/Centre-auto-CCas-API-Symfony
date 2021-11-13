<?php

namespace App\Entity;

use App\Repository\GarageRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GarageRepository", repositoryClass=GarageRepository::class)
 *
 */
class Garage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"garages"})
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     * @Groups({"classifiedAdById"})
     */
    private int $id;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"garages"})
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups ({"users"})
     */
    private string $name;


    /**
     * @ORM\Column(type="json")
     * @Groups({"garages"})
     */
    private array $imageGarage;


    /**
     * @ORM\Column(type="integer")
     * @Groups({"garages"})
     * @Groups({"classifiedAd"})
     * @Groups ({"users"})
     */
    private int $streetNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"garages"})
     * @Groups({"classifiedAd"})
     * @Groups ({"users"})
     */
    private string $streetName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"garages"})
     * @Groups({"classifiedAd"})
     * @Groups ({"users"})
     *
     */
    private string $address;

    /**
     * @ORM\Column(type="integer", length=255)
     * @Groups({"garages"})
     * @Groups({"classifiedAd"})
     * @Groups ({"users"})
     */
    private int $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"garages"})
     * @Groups({"classifiedAd"})
     * @Groups ({"users"})
     */
    private string $city;

    /**
     * @ORM\ManyToOne(targetEntity=User::class,cascade={"persist"}, inversedBy="garages")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"garages"})
     */
    private  $user;

    /**
     * @ORM\OneToMany(targetEntity=ClassifiedAd::class, mappedBy="garage", orphanRemoval=true)
     * @Groups({"garages"})
     */
    private Collection $classifiedAds;

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
     * @return Garage
     */
    public function setId(int $id): Garage
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Garage
     */
    public function setName(string $name): Garage
    {
        $this->name = $name;
        return $this;
    }



    /**
     * @return int
     */
    public function getStreetNumber(): int
    {
        return $this->streetNumber;
    }

    /**
     * @param int $streetNumber
     * @return Garage
     */
    public function setStreetNumber(int $streetNumber): Garage
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetName(): string
    {
        return $this->streetName;
    }

    /**
     * @param string $streetName
     * @return Garage
     */
    public function setStreetName(string $streetName): Garage
    {
        $this->streetName = $streetName;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Garage
     */
    public function setAddress(string $address): Garage
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostalCode(): int
    {
        return $this->postalCode;
    }

    /**
     * @param int $postalCode
     * @return Garage
     */
    public function setPostalCode(int $postalCode): Garage
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Garage
     */
    public function setCity(string $city): Garage
    {
        $this->city = $city;
        return $this;
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
     * @return Garage
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getClassifiedAds(): Collection
    {
        return $this->classifiedAds;
    }

    /**
     * @param Collection $classifiedAds
     * @return Garage
     */
    public function setClassifiedAds(Collection $classifiedAds): Garage
    {
        $this->classifiedAds = $classifiedAds;
        return $this;
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
     * @return Garage
     */
    public function setCreatedAt(DateTimeInterface $createdAt): Garage
    {
        $this->createdAt = $createdAt;
        return $this;
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
     * @return Garage
     */
    public function setUpdatedOnAt(DateTimeInterface $updatedOnAt): Garage
    {
        $this->updatedOnAt = $updatedOnAt;
        return $this;
    }

    /**
     * @return array
     */
    public function getImageGarage(): array
    {
        return $this->imageGarage;
    }

    /**
     * @param array $imageGarage
     */
    public function setImageGarage(array $imageGarage): void
    {
        $this->imageGarage = $imageGarage;
    }


}
