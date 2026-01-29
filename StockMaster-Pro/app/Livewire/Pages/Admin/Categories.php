<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\CategoryService;
class Categories extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render(CategoryService $categoryService)
    {

        $categories = $categoryService->getAll($this->search);
        return view('livewire.pages.admin.category-index',compact('categories'))->layout('layouts.admin');
    }
}
