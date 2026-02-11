<?php

namespace App\Livewire\Pages\Invoices;

use App\Models\StockAdjustment; // T-akked men smiya d l-model
use Livewire\Component;
use Livewire\WithPagination;

class Invoices extends Component
{
    use WithPagination;

    public $search = '';

    // Bach pagination t-reset melli t-searchi
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Eager Loading (with) bach n-fadao N+1 mouchkil
        $adjustments = StockAdjustment::with(['product', 'user'])
            ->whereHas('product', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pages.invoices.invoices', [
            'adjustments' => $adjustments
        ])->layout('layouts.admin');
    }
}