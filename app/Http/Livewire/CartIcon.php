<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ShoppingCart;

class CartIcon extends Component
{
    public $cartCount = 0;
    protected $listeners = ['updateCartCount' => 'updateCartCount'];
    
    public function mount()
    {
        $this->cartCount = count(ShoppingCart::where('user_id', auth()->id())->get());
    }
    
    public function updateCartCount()
    {
        $this->cartCount = count(ShoppingCart::where('user_id', auth()->id())->get());
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
