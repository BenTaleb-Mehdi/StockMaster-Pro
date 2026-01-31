<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // Darori bach t-upload tswira
use App\Services\CategoryService;
use Illuminate\Support\Facades\Storage;

class Categories extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $name, $slug, $description, $image;
    public $currentImagePath; // Bach n-biyen tswira l-qdima f Edit
    public $isEdit = false;
    public $CategoryId;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Function bach t-khwi l-form (Add New)
    public function create()
    {
        $this->reset(['name', 'slug', 'description', 'image', 'CategoryId', 'currentImagePath']);
        $this->isEdit = false;
        $this->resetValidation();
    }

    public function edit($id, CategoryService $categoryService)
    {
        $this->create(); // Khwi kolchi qbel ma t-3emmer b Edit
        $this->isEdit = true;
        $this->CategoryId = $id;
        
        $category = $categoryService->find($id);
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->currentImagePath = $category->image_path; // Smiya d tswira f DB
    }

    public function save(CategoryService $categoryService)
    {
        $rules = [
            'name' => 'required|min:3',
            'slug' => 'required|unique:categories,slug,' . ($this->CategoryId ?? 'NULL'),
            'description' => 'nullable|max:500',
            'image' => $this->isEdit ? 'nullable|image|max:1024' : 'required|image|max:1024',
        ];

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ];

        // Logic dial t-tsawer
        if ($this->image) {
            // Msa7 l-qdima ila kanet
            if ($this->isEdit && $this->currentImagePath) {
                Storage::disk('public')->delete($this->currentImagePath);
            }
            $data['image_path'] = $this->image->store('categories', 'public');
        }

        if ($this->isEdit) {
            $categoryService->update($this->CategoryId, $data);
        } else {
            $categoryService->store($data);
        }

        $this->create(); // Reset form
        $this->dispatch('category-updated'); // Close Modal
    }

    // Delete b Confirm
    public function delete($id, CategoryService $categoryService)
    {
        $category = $categoryService->find($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $categoryService->delete($id);
        $this->dispatch('category-deleted');
    }

    public function render(CategoryService $categoryService)
    {
        $categories = $categoryService->getAll($this->search);
        return view('livewire.pages.admin.category-index', compact('categories'))
            ->layout('layouts.admin');
    }
}