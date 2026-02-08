<?php

namespace App\Services;

use App\Models\suppliers;

class supplierService
{
    public function getAllSuppliers($search = '', $categoryId = '')
    {
        return suppliers::query()
            ->when($search, function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
            })
            ->when($categoryId, function($query) use ($categoryId) {
                $query->whereHas('products', function($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                });
            })
            ->latest()
            ->paginate(10);
    }

    public function getSupplierById($id) { return suppliers::findOrFail($id); }
    public function createSupplier($data) { return suppliers::create($data); }
    public function updateSupplier($id, $data) { 
        $supplier = suppliers::findOrFail($id);
        $supplier->update($data);
        return $supplier;
    }
    public function deleteSupplier($id) { return suppliers::destroy($id); }
}