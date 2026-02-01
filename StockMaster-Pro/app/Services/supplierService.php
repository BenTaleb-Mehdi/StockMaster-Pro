<?php
namespace App\Services;

use App\Models\suppliers;
use Illuminate\Support\Facades\DB;
class supplierService {


public function getAllSuppliers($searchTerm = ''){
        return suppliers::where('name', 'like', '%'.$searchTerm.'%')
                ->orWhere('phone', 'like', '%'.$searchTerm.'%') 
                ->latest() 
                ->paginate(8);
    }

    public function getAll() {
        return suppliers::all();
    }

    public function getSupplierById($id){
        return suppliers::findOrFail($id);
    }

    public function createSupplier($data){
        return suppliers::create($data);
    }

    public function updateSupplier($id, $data){
        $supplier = suppliers::findOrFail($id);
        $supplier->update($data);
        return $supplier;
    }

    public function deleteSupplier($id){
        $supplier = suppliers::findOrFail($id);
        $supplier->delete();
        return $supplier;
    }
}