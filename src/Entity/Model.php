<?php

namespace App\Entity;



use App\Repository\ModelRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModelRepository", repositoryClass=ModelRepository::class)
 *
 */
class Model
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"classifiedAdById"})
     * @Groups({"model"})
     */
    private  $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"model"})
     */
    private  $name;

    /**
     * @ORM\OneToMany(targetEntity=ClassifiedAd::class, mappedBy="model", orphanRemoval=true)
     */
    private $classifiedAds;

    /**
     * @ORM\OneToMany(targetEntity=Manufacturer::class, mappedBy="model", orphanRemoval=true)
     * @Groups({"model"})
     */
    private $manufacturer;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Model
     */
    public function setId($id): Model
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
     * @return Model
     */
    public function setName($name): Model
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
     * @return Model
     */
    public function setClassifiedAds($classifiedAds): Model
    {
        $this->classifiedAds = $classifiedAds;
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
     * @return Model
     */
    public function setManufacturer($manufacturer): Model
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }


}