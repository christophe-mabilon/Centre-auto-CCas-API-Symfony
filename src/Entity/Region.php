<?php

namespace App\Entity;


use App\Repository\RegionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 *
 */
class Region
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"classifiedAdById"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     */
    private string $name;

    /**
     * @ORM\OneToOne(targetEntity=ClassifiedAd::class, mappedBy="region")
     */
    private $classifiedAd;

    /**
     * @ORM\OneToMany(targetEntity=ClassifiedAd::class, mappedBy="region", orphanRemoval=true)
     */
    private Collection $classifiedAds;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Region
     */
    public function setId(int $id): Region
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
     * @return Region
     */
    public function setName(string $name): Region
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClassifiedAd()
    {
        return $this->classifiedAd;
    }

    /**
     * @param mixed $classifiedAd
     * @return Region
     */
    public function setClassifiedAd($classifiedAd): Region
    {
        $this->classifiedAd = $classifiedAd;
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
     * @return Region
     */
    public function setClassifiedAds(Collection $classifiedAds): Region
    {
        $this->classifiedAds = $classifiedAds;
        return $this;
    }


}
