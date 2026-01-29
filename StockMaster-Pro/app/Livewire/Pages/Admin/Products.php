<?php

namespace App\Livewire\Pages\Admin;
use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithPagination;
class Products extends Component
{
    use WithPagination;
// 1. Define the property
    public $search = '';

    // 2. Reset pagination when searching
    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render(ProductService $productService)
    {
        
        $products = $productService->getAll($this->search);
        
        return view('livewire.pages.admin.product-index',compact('products'))->layout('layouts.admin'); 
    }
}
