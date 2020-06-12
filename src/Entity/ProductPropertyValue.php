<?php

namespace App\Entity;

use App\Repository\ProductPropertyValueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductPropertyValueRepository::class)
 */
class ProductPropertyValue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=ProductProperty::class, inversedBy="productPropertyValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $property;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getProperty(): ?ProductProperty
    {
        return $this->property;
    }

    public function setProperty(?ProductProperty $property): self
    {
        $this->property = $property;

        return $this;
    }
}
