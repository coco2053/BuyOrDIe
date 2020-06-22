<?php

namespace App\Service;

use App\Repository\ProductRepository;
use App\Repository\ProductPropertyRepository;
use App\Repository\CategoryRepository;

class AutoComplete
{

    private $productRepo;
    private $productPropertyRepo;
    private $productCategoryRepo;

    public function __construct(ProductRepository $productRepo, ProductPropertyRepository $productPropertyRepo, CategoryRepository $productCategoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->productPropertyRepo = $productPropertyRepo;
        $this->productCategoryRepo = $productCategoryRepo;
    }

    public function autoComplete($input, $class)
    {
        switch ($class) {
            case 'ProductBrand':
                return $this->autoBrand($input);
                break;
            case 'ProductPropertyName':
                return $this->autoPropertyName($input);
                break;
            case 'ProductPropertyValue':
                return $this->autoPropertyValue($input);
                break;
            case 'ProductCategory':
                return $this->autoCategory($input);
                break;
        }
    }

    public function autoBrand($input)
    {
        $brands = [];
        $products = $this->productRepo->findBrandBeginWith($input);
        foreach($products as $product) {
            $brands[] = $product->getBrand();
        }
        return $brands;
    }

    public function autoPropertyName($input)
    {
        $names = [];
        $productProperties = $this->productPropertyRepo->findNameBeginWith($input);
        foreach($productProperties as $property) {
            $names[] = $property->getName();
        }
        return $names;
    }

    public function autoPropertyValue($input)
    {
        $values = [];
        $productProperties = $this->productPropertyRepo->findValueBeginWith($input);
        foreach($productProperties as $property) {
            $values[] = $property->getValue();
        }
        return $values;
    }

    public function autoCategory($input)
    {
        $categories = [];
        $productCategories = $this->productCategoryRepo->findNameBeginWith($input);
        foreach($productCategories as $category) {
            $categories[] = $category->getName();
        }
        return $categories;
    }
}
