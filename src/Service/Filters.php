<?php

namespace App\Service;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

class Filters
{

    private $productRepo;
    private $productCategoryRepo;

    public function __construct(ProductRepository $productRepo, CategoryRepository $productCategoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->productCategoryRepo = $productCategoryRepo;
    }

    public function filterFetch($data)
    {
        if($data == null) {
            return $this->productRepo->findAll();
        }
        if($data['category'] == 'null' and $data['brand'] == 'null') {
            return $this->productRepo->findAll();
        }
        return $this->productRepo->filter($data);
        /*switch ($filter) {
            case 'category':
                return $this->productRepo->findByCategory($value);
            case 'brand':
                return $this->productRepo->findBy(['brand' =>$value]);
        }*/
    }

    public function filterBrand()
    {
        $brands = [];
        $productBrands = $this->productRepo->findAllBrands();

        foreach($productBrands as $brand) {
            $brands[] = $brand['brand'];
        }

        return $brands;

    }

    public function filterCategory()
    {
        $categories = [];
        $productCategories = $this->productCategoryRepo->findAllNames();
        foreach($productCategories as $category) {
            $categories[] = $category['name'];
        }
        return $categories;
    }
}
