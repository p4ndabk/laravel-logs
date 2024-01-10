<?php

namespace App\Services;

use App\Models\Product;
use App\Filters\ProductsFilter;

class ProductService
{
    public function getProducts(array $filter = [])
    {
        $productFilter = new ProductsFilter($filter);

        $query = Product::query();
        $productFilter->apply($query, $filter);

        return $query->get();
    }
}