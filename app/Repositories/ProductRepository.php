<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getProductsByUser($userId)
    {
        return Product::query()
            ->where('c_id', $userId)
            ->get();
    }
    
    public function countDistinctCategories($userId)
    {
        return Product::where('c_id', $userId)->distinct('category')->count('category');
    }

    public function countProducts($userId)
    {
        return Product::where('c_id', $userId)->count();
    }
}
