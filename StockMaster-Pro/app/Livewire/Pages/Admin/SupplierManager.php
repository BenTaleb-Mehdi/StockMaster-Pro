<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Services\supplierService;
class SupplierManager extends Component
{

    public $name, $phone, $address;
    public $supplierId;
    public $isEditing = false;
    public $search = '';
   

public function create()
    {
        $this->reset(['name', 'phone', 'address', 'supplierId']);
        $this->isEditing = false; 
    }

    public function edit($id, supplierService $supplierService){
        $supplier = $supplierService->getSupplierById($id);
        $this->name = $supplier->name;
        $this->phone = $supplier->phone;
        $this->address = $supplier->address;
        $this->supplierId = $supplier->id;
        $this->isEditing = true;
    }
    
    public function save(supplierService $supplierService){

        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
        ];

        if($this->isEditing){
            $supplier = $supplierService->updateSupplier($this->supplierId, $data);
            $this->dispatch('supplier-updated');
           
        } else {
            $supplier = $supplierService->createSupplier($data);
            $this->dispatch('supplier-added');
            
        }

        $this->reset();
    }


    public function destory($id, supplierService $supplierService){
        $supplier = $supplierService->deleteSupplier($id);
        $this->dispatch('supplier-deleted');    
    }



    public function render(supplierService $supplierService)
    {
        $suppliers = $supplierService->getAllSuppliers($this->search);
        return view('livewire.pages.admin.supplier-manager', compact('suppliers'))
        ->layout('layouts.admin');
    }
}
