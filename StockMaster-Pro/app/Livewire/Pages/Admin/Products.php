<?php

namespace App\Livewire\Pages\Admin;

use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\SupplierService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithPagination, WithFileUploads;

    // Form Properties
    public $name, $sku, $quantity, $price, $image, $productId;
    public $category_id;
    public $supplier_id;
    public $min_stock = 5;
    public $selectedCategory = '';
    
    // UI Properties (bach AlpineJS y-t-syncrona)
    public $productCategoryName = 'Select Category';
    public $productSupplierName = 'Select Supplier';
    public $currentImagePath;
    public $isEdit = false;
    
    public $search = '';
    protected $listeners = ['stockUpdated' => '$refresh', 'destroy'];
    public function updatingSelectedCategory() { $this->resetPage(); }
    public function updatingSearch() { $this->resetPage(); }

    public function create()
    {
        // Reset ga3 l-fields
        $this->reset([
            'name', 'sku', 'category_id', 'supplier_id', 
            'quantity', 'price', 'image', 'productId', 
            'currentImagePath'
        ]);
        
        $this->isEdit = false;
        $this->min_stock = 5; 
        $this->productCategoryName = 'Select Category';
        $this->productSupplierName = 'Select Supplier';
    }

    public function edit($id, ProductService $productService) 
    {
        $this->isEdit = true;
        $this->productId = $id;
        $product = $productService->findProduct($id);

        $this->name = $product->name;
        // Bach may-banx PR- f l-input melli n-bghiw n-modifiw
        $this->sku = str_replace('PR-', '', $product->sku); 
        
        $this->category_id = $product->category_id;
        $this->productCategoryName = $product->category->name ?? 'Select Category';
        
        $this->supplier_id = $product->supplier_id;
        $this->productSupplierName = $product->supplier->name ?? 'Select Supplier';
        
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->min_stock = $product->min_stock;
        $this->currentImagePath = $product->image_path;
    }

    public function destroy($id, ProductService $productService)
    {
        $productService->delete($id);
        $this->dispatch('swal:modal', [
            'type' => 'success',
            'title' => 'Produit supprimé!',
            'text' => 'Le produit a été définitivement supprimé.'
        ]);
    }

    public function save(ProductService $productService)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . ($this->productId ?? 'NULL'),
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'min_stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'image' => 'nullable|image|max:2048', // 2MB max
        ];

        $this->validate($rules);

        $data = [
            'name'        => $this->name,
            'sku'         => $this->isEdit ? $this->sku : 'PR-' . $this->sku,
            'category_id' => $this->category_id,
            'supplier_id' => $this->supplier_id,
            'quantity'    => $this->quantity,
            'price'       => $this->price,
            'min_stock'   => $this->min_stock,
        ];

        if ($this->image) {
            $data['image_path'] = $this->image->store('products', 'public');
        }

        if ($this->isEdit) {
            $product = $productService->findProduct($this->productId);
            $product->update($data);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Produit mis à jour!',
                'text' => 'Le produit a été modifié avec succès.'
            ]);
        } else {
            $productService->store($data);
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Produit ajouté!',
                'text' => 'Le nouveau produit a été ajouté au stock.'
            ]);
        }

        $this->create(); // Reset Everything
    }

public function render(ProductService $productService, CategoryService $categoryService, SupplierService $supplierService)
{
    return view('livewire.pages.admin.product-index', [
        // Pass the category ID to the service
        'products'   => $productService->getAll($this->search, $this->selectedCategory),
        'categories' => $categoryService->getAll(),
        'suppliers'  => $supplierService->getAllSuppliers(),
    ])->layout('layouts.admin'); 
}
}