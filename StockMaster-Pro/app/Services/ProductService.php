<?php

namespace App\Services;

use App\Models\products;
use Livewire\WithPagination;

class ProductService
{
    use WithPagination;
    public function getAll($search = null) {
        return products::with('category')
            ->when($search, function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('sku', 'like', "%{$search}%");
            })->latest()->paginate(5);
    }

    public function calculateStockPercentage($total, $lowStock){
        if ($total <= 0) return 0;
    
        $percentage = (($total - $lowStock) / $total) * 100;
        return number_format($percentage, 0);
    }


    public function getAllCount() {
        return products::count();
    }

    public function getRevenue(){
      
            $totalRevenueLastMonth = products::where('created_at', '>=', now()->subDays(30))->sum('price');
        return $totalRevenueLastMonth;
       
    }

    public function store(array $data) {
        return products::create($data);
    }

    public function update($id, array $data) {
        return products::findOrFail($id)->update($data);
    }

    public function delete($id) {
        return products::findOrFail($id)->delete();
    }
    public function getLowStock() {
        // S-tariqa l-as-hal:
        return products::whereRaw('quantity <= min_stock')->latest()->get();
    }

    public function getLowStockCount() {
        // S-tariqa l-as-hal:
        return products::whereRaw('quantity <= min_stock')->count();
    }
}