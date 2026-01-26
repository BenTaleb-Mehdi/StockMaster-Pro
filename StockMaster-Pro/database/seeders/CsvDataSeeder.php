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
       
       $categories = $this->parse(database_path('data/categories.csv'));
        foreach ($categories as $cat) {
            $this->inventoryService->category->create($cat);
        }

   
        $products = $this->parse(database_path('data/products.csv'));
        foreach ($products as $prod) {
            $this->inventoryService->product->create($prod);
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