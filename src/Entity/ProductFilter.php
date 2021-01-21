<?php

namespace App\Entity;

use App\Repository\ProductFilterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductFilterRepository::class)
 */
class ProductFilter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filterGroupCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilterGroupCode(): ?string
    {
        return $this->filterGroupCode;
    }

    public function setFilterGroupCode(string $filterGroupCode): self
    {
        $this->filterGroupCode = $filterGroupCode;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }
}
