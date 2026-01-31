<?php
namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Services\StockService; // Ma-tnsach t-importih
use Livewire\Attributes\On;    // Ila knti v3

class StockAdjuster extends Component
{
    public $productId, $quantity, $type = 'addition', $reason;
    public $isOpen = false;

    #[On('openAdjustmentModal')]
    public function loadModal($id) 
    {
        $this->productId = $id;
        $this->isOpen = true;
        $this->resetValidation(); 
    }

    public function save(StockService $service) 
    {
        $this->validate([
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string',
            'type' => 'required|in:addition,subtraction'
        ]);

        try {
            $service->adjust($this->productId, $this->quantity, $this->type, $this->reason);
            
            $this->isOpen = false; 
            $this->reset(['quantity', 'reason', 'type']); 
            
            $this->dispatch('stockUpdated'); 
            
            session()->flash('success', 'Stock updated successfully!');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        $this->dispatch('stockUpdated');
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.pages.admin.partials.stock-adjuster');
    }
}