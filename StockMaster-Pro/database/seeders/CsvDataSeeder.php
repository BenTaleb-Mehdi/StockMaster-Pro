<?php

namespace Database\Seeders;

use App\Services\InventoryService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CsvDataSeeder extends Seeder
{
    public $inventoryService;

   
    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

public function run(): void
{
    // 1. Seeding Categories (Dima hiya l-lowla hit l-produit kaye-htajha)
    $categories = $this->parse(database_path('data/categories.csv'));
    foreach ($categories as $cat) {
        $this->inventoryService->category->firstOrCreate(
            ['slug' => $cat['slug'] ?? \Illuminate\Support\Str::slug($cat['name'])],
            $cat
        );
    }

    // 2. Seeding Suppliers (Daba zid hado HNA, 9bel l-products!)
    // Haka melli i-ji l-product fih supplier_id=1, ghadi i-lqah dejà m-kriyi
    $suppliers = $this->parse(database_path('data/suppliers.csv'));
    foreach ($suppliers as $supplier) {
        $this->inventoryService->supplier->firstOrCreate(
            ['name' => $supplier['name']], 
            $supplier
        );
    }

    // 3. Seeding Products (Hado homa l-lekhrin hit m-rebttin b kolchi)
    $products = $this->parse(database_path('data/products.csv'));
    foreach ($products as $prod) {
        $this->inventoryService->product->firstOrCreate(
            ['name' => $prod['name']], 
            $prod
        );
    }
}

  
    private function parse($path): array
    {
        if (!File::exists($path)) return [];
        
        $rows = str_getcsv(File::get($path), "\n");
        $header = str_getcsv(array_shift($rows), ",");
        $data = [];
        
        foreach ($rows as $row) {
            $data[] = array_combine($header, str_getcsv($row, ","));
        }
        
        return $data;
    }
}