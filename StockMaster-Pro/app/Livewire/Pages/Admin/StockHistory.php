<?php
namespace App\Livewire\Pages\Admin;


use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockService;
class StockHistory extends Component
{
    use WithPagination;

    public $selectedCategory = '';
    public $search = '';

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render(StockService $stockService, \App\Services\CategoryService $categoryService)
    {
        $history = $stockService->getHistory($this->selectedCategory, $this->search);
        $categories = $categoryService->getAll();
        
        return view('livewire.pages.admin.stock-history', compact('history', 'categories'))
            ->layout('layouts.admin');
    }
}