<?php

namespace App\Entity;


use App\Repository\ManufacturerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ManufacturerRepository", repositoryClass=ManufacturerRepository::class)
 *
 *
 */
class Manufacturer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"brand"})
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="manufacturer")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"model"})
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="manufacturer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $model;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Manufacturer
     */
    public function setId(int $id): Manufacturer
    {
        $this->id = $id;
        return $this;
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
     * @return Manufacturer
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
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
     * @return Manufacturer
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

}