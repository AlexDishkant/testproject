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

    /**
     * @ORM\Column(type="integer")
     */
    private $catalogId;


    /**
     * @ORM\column(type="integer")
     * @param $name
     * @param $description
     * @param $price
     * @param $code
     * @param $catalogId
     */

    public function __construct (string $name, string $description, int $price, int $code, int $catalogId)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setDescription($description);
        $this->setCode($code);
        $this->setCatalogId($catalogId);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCatalogId(): ?int
    {
        return $this->catalogId;
    }

    public function setCatalogId($catalogId): self
    {
        $this->catalogId = $catalogId;

        return $this;
    }
}
