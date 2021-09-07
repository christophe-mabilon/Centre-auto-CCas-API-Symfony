<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 *
 */
class Brand
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"brand"})
     * @Groups({"model"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"brand"})
     * @Groups({"model"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ClassifiedAd::class, mappedBy="brand", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $classifiedAds;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"brand"})
     */
    private $img;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"brand"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Manufacturer::class, mappedBy="brand", orphanRemoval=true)
     */
    private  $manufacturer;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Brand
     */
    public function setId($id): Brand
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Brand
     */
    public function setName($name): Brand
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClassifiedAds()
    {
        return $this->classifiedAds;
    }

    /**
     * @param mixed $classifiedAds
     * @return Brand
     */
    public function setClassifiedAds($classifiedAds): Brand
    {
        $this->classifiedAds = $classifiedAds;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     * @return Brand
     */
    public function setImg($img): Brand
    {
        $this->img = $img;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Brand
     */
    public function setDescription($description): Brand
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param mixed $manufacturer
     * @return Brand
     */
    public function setManufacturer($manufacturer): Brand
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }



}