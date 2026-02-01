<?php
namespace App\Livewire\Pages\Admin;


use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockService;
class StockHistory extends Component
{
    use WithPagination;

    public function render(StockService $stockService)
    {
        $history = $stockService->getHistory();
        return view('livewire.pages.admin.stock-history', compact('history'))->layout('layouts.admin');
    }
}