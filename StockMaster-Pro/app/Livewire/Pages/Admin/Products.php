<?php

namespace App\Livewire\Pages\Admin;
use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\SupplierService;
class Products extends Component
{
    use WithPagination;
    use \Livewire\WithFileUploads;

    // Properties for form
    public $name;
    public $sku;
    public $category_id;  
    public $productCategoryName;  
    public $image;
    public $quantity;
    public $price;
    public $min_stock = 5;

    // edit products variables
    public $isEdit = false;
    public $productId;
    
    public $supplier_id; // Khass y-kon hna
    public $productSupplierName = 'Select Supplier';
    // Search property
    public $search = '';
    protected $listeners = ['stockUpdated' => '$refresh'];

    // Reset pagination when searching
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        // Kan-reset-iw ga3 l-variables l-asliya
        $this->reset(['name', 'sku', 'category_id', 'productCategoryName', 'image', 'quantity', 'price', 'productId', 'supplier_id', 'productSupplierName']);
        
        $this->isEdit = false;
        $this->min_stock = 5; 
        $this->productCategoryName = 'Select Category'; // Bach l-input dial l-category i-khwa
        $this->productSupplierName = 'Select Supplier'; // Bach l-input dial l-supplier i-khwa
    }

    public $currentImagePath;

    public function edit($id, ProductService $productService) {
        $this->isEdit = true;
        $this->productId = $id;
        $product = $productService->findProduct($id);

        $this->name = $product->name;
        $this->sku = str_replace('PR-', '', $product->sku); // Remove prefix if needed for display
        $this->category_id = $product->category_id;
        $this->productCategoryName = $product->category->name;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->supplier_id = $product->supplier_id;
        $this->productSupplierName = $product->supplier->name;
        $this->min_stock = $product->min_stock;
        $this->currentImagePath = $product->image_path; // New variable
    }
    

    public function save(ProductService $productService)
    {
        // 1. Validation logic bignore SKU f l-update
        $rules = [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . ($this->productId ?? 'NULL'),
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'min_stock' => 'required|integer|min:5',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'image' => 'nullable|image|max:1024',
        ];

        $this->validate($rules);

        if($this->isEdit){
            $product = $productService->findProduct($this->productId);
            $updateData = [
                'name' => $this->name,
                'sku' => $this->sku,
                'category_id' => $this->category_id,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'min_stock' => $this->min_stock,
                'supplier_id' => $this->supplier_id,
            ];
            
            if ($this->image) {
                $updateData['image_path'] = $this->image->store('products', 'public');
            }

            $product->update($updateData);
        } else {
            $data = [
                'name' => $this->name,
                'sku' => 'PR-' . $this->sku,
                'category_id' => $this->category_id,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'min_stock' => $this->min_stock,
                'supplier_id' => $this->supplier_id,
            ];

            if ($this->image) {
                $data['image_path'] = $this->image->store('products', 'public');
            }

            $productService->store($data);
        }

        // 2. Reset kolchi f l-ekher bach l-add jdid ikon nqi
        $this->create();
        $this->dispatch('product-added'); 
    }


    public function destory($id,ProductService $productService){
        $product = $productService->findProduct($id);
        $product->delete();
    }

    public function render(ProductService $productService, \App\Services\CategoryService $categoryService, \App\Services\SupplierService $supplierService)
    {
        $suppliers = $supplierService->getAll();
        $products = $productService->getAll($this->search);
        $categories = $categoryService->getAll();
        
        return view('livewire.pages.admin.product-index', compact('products', 'categories', 'suppliers'))
            ->layout('layouts.admin'); 
    }
}
