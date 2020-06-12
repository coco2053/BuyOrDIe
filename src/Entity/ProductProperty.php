<?php

namespace App\Entity;

use App\Repository\ProductPropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductPropertyRepository::class)
 */
class ProductProperty
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="properties")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=ProductPropertyValue::class)
     */
    private $property;

    /**
     * @ORM\OneToMany(targetEntity=ProductPropertyValue::class, mappedBy="property", orphanRemoval=true)
     */
    private $productPropertyValues;

    public function __construct()
    {
        $this->productPropertyValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProperty(): ?ProductPropertyValue
    {
        return $this->property;
    }

    public function setProperty(?ProductPropertyValue $property): self
    {
        $this->property = $property;

        return $this;
    }

    /**
     * @return Collection|ProductPropertyValue[]
     */
    public function getProductPropertyValues(): Collection
    {
        return $this->productPropertyValues;
    }

    public function addProductPropertyValue(ProductPropertyValue $productPropertyValue): self
    {
        if (!$this->productPropertyValues->contains($productPropertyValue)) {
            $this->productPropertyValues[] = $productPropertyValue;
            $productPropertyValue->setProperty($this);
        }

        return $this;
    }

    public function removeProductPropertyValue(ProductPropertyValue $productPropertyValue): self
    {
        if ($this->productPropertyValues->contains($productPropertyValue)) {
            $this->productPropertyValues->removeElement($productPropertyValue);
            // set the owning side to null (unless already changed)
            if ($productPropertyValue->getProperty() === $this) {
                $productPropertyValue->setProperty(null);
            }
        }

        return $this;
    }
}
