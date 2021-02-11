<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    public $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    private $catalog;

    /**
     * @ORM\column(type="integer")
     * @param string $name
     * @param int $price
     * @param string $description
     * @param int $code
     * @param Catalog $catalog
     */

    public function __construct (string $name, int $price, string $description, int $code, Catalog $catalog)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setDescription($description);
        $this->setCode($code);
        $this->catalog = $catalog;

    }

    public function getCatalog(Catalog $catalog): Catalog
    {
        return $this->catalog;
    }

    public function setCatalog(Catalog $catalog)
    {
        $this->catalog = $catalog;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->name;
    }

    public function setName( $name): Product
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice($price): Product
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description): Product
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode($code): Product
    {
        $this->code = $code;

        return $this;
    }
}
