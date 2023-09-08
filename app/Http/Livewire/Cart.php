<?php

namespace App\Http\Livewire;

use App\Models\AbandonedProducts;
use Livewire\Component;
use App\Models\ShoppingCart;

class Cart extends Component
{
    public $cartItems;
    public $confirmingDeleteItem = false;
    public $itemToDelete = null;
    public $subtotal = 0;
    public $total = 0;
    public $selectedItems = [];
    public $selectAll = false;
    public $confirmingDeleteAll = false;

    public function mount()
    {
        $this->loadCartItems();
    }

    public function decrementQuantity($cartItemId)
    {
        $cartItem = ShoppingCart::findOrFail($cartItemId);

        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }

        $this->loadCartItems();
        $this->calculateTotal();
    }

    public function incrementQuantity($cartItemId)
    {
        $cartItem = ShoppingCart::findOrFail($cartItemId);

        if ($cartItem->quantity < $cartItem->product->quantity) {
            $cartItem->increment('quantity');
        }

        $this->loadCartItems();
        $this->calculateTotal();
    }

    public function loadCartItems()
    {
        $this->cartItems = ShoppingCart::where('user_id', auth()->id())->get();
    }

    public function confirmDelete($cartItemId)
    {
        $this->confirmingDeleteItem = true;
        $this->itemToDelete = $cartItemId;
    }

    public function cancelDelete()
    {
        $this->confirmingDeleteItem = false;
        $this->itemToDelete = null;
    }

    public function deleteItem()
    {
        $cartItem = ShoppingCart::findOrFail($this->itemToDelete);
        $cartItem->delete();

        AbandonedProducts::create([
            'product_id' => $cartItem->product_id,
            'user_id' => auth()->id(),
        ]);

        $this->confirmingDeleteItem = false;
        $this->itemToDelete = null;

        $this->loadCartItems();
        $this->emit('updateCartCount');
    }

    public function calculateTotal()
    {
        $this->total = 0;
        $this->subtotal = 0;

        foreach ($this->cartItems as $cartItem) {
            if (isset($this->selectedItems[$cartItem->id]) && $this->selectedItems[$cartItem->id]) {
                $this->subtotal += $cartItem->product->price * $cartItem->quantity;
                $this->total += $cartItem->product->price * $cartItem->quantity;
            }
        }
    }
    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;

        foreach ($this->cartItems as $cartItem) {
            $this->selectedItems[$cartItem->id] = $this->selectAll;
        }

        $this->calculateTotal();
    }

    public function confirmDeleteAll()
    {
        if(count(array_filter($this->selectedItems)) > 0) {
            $this->confirmingDeleteAll = true;
        } else {
            $this->emit('show-no-items-selected-popup');
        }
    }

    public function cancelDeleteAll()
    {
        $this->confirmingDeleteAll = false;
    }

    public function deleteAllItem()
    {
        foreach ($this->cartItems as $cartItem) {
            if (isset($this->selectedItems[$cartItem->id]) && $this->selectedItems[$cartItem->id]) {
                $cartItem->delete();
                AbandonedProducts::create([
                    'product_id' => $cartItem->product_id,
                    'user_id' => auth()->id(),
                ]);
            }
        }
        

        $this->confirmingDeleteAll = false;
        $this->emit('updateCartCount');
        $this->loadCartItems();
        $this->calculateTotal();
    }

    public function proceedToCheckout()
    {
        $selectedProducts = $this->cartItems->filter(function ($cartItem) {
            return isset($this->selectedItems[$cartItem->id]) && $this->selectedItems[$cartItem->id];
        });
    
        if ($selectedProducts->isEmpty()) {
            $this->emit('show-no-items-selected-popup');
        } else {
            session()->put('selectedProducts', $selectedProducts->toArray());
            return redirect()->route('users.checkout');      
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
