<?php

namespace App\Services;

use App\Models\categories;
use App\Models\products;
use App\Models\suppliers;
use Illuminate\Database\Eloquent\Collection;

class InventoryService
{
    public $product;
    public $category;
    public $supplier; 

    public function __construct(products $product, categories $category, suppliers $supplier)
    {
        $this->product = $product;
        $this->category = $category;
        $this->supplier = $supplier; 
    }

    public function listAllProducts()
    {

        return $this->product->with(['categories', 'suppliers'])->get();
    }
}