<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\supplierService;
use App\Services\CategoryService;

class SupplierManager extends Component
{
    use WithPagination;

    public $name, $phone, $address, $supplierId;
    public $isEditing = false;
    public $search = '';
    public $selectedCategory = '';

    // Reset pagination when search or category changes
    public function updatedSearch() { $this->resetPage(); }
    public function updatedSelectedCategory() { $this->resetPage(); }

    protected $listeners = ['destroy'];

    public function create()
    {
        $this->reset(['name', 'phone', 'address', 'supplierId']);
        $this->isEditing = false; 
    }

    public function edit($id, supplierService $supplierService)
    {
        $supplier = $supplierService->getSupplierById($id);
        $this->name = $supplier->name;
        $this->phone = $supplier->phone;
        $this->address = $supplier->address;
        $this->supplierId = $supplier->id;
        $this->isEditing = true;
    }
    
    public function save(supplierService $supplierService)
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $data = ['name' => $this->name, 'phone' => $this->phone, 'address' => $this->address];

        if($this->isEditing){
            $supplierService->updateSupplier($this->supplierId, $data);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Fournisseur mis à jour!',
                'text' => 'Les informations du fournisseur ont été modifiées.'
            ]);
        } else {
            $supplierService->createSupplier($data);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Fournisseur ajouté!',
                'text' => 'Le nouveau fournisseur a été ajouté.'
            ]);
        }

        $this->reset(['name', 'phone', 'address', 'supplierId', 'isEditing']);
    }

    public function destroy($id, supplierService $supplierService)
    {
        $supplierService->deleteSupplier($id);
        $this->dispatch('swal:modal', [
            'type' => 'success',
            'title' => 'Fournisseur supprimé!',
            'text' => 'Le fournisseur a été supprimé avec succès.'
        ]);    
    }

    public function render(supplierService $supplierService, CategoryService $categoryService)
    {
        return view('livewire.pages.admin.supplier-manager', [
            'suppliers' => $supplierService->getAllSuppliers($this->search, $this->selectedCategory),
            'categories' => $categoryService->getAll(), 
        ])->layout('layouts.admin');
    }
}