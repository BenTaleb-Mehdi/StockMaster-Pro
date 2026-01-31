<?php
namespace App\Livewire\Pages\Seller;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.Seller.dashboard')->layout('layouts.seller');
    }
}