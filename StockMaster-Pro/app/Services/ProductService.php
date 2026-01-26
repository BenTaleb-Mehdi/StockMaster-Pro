<?php

namespace App\Services;

use App\Models\products;

class ProductService
{
    public function getAll($search = null) {
        return products::with('category')
            ->when($search, function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('sku', 'like', "%{$search}%");
            })->latest()->get();
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
        return products::whereRaw('quantity <= min_stock')->get();
    }
}