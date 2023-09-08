<?php

namespace App\Http\Livewire;


use App\Http\Middleware\TrackMostAddedToCart;
use App\Models\MostAddedToCartProduct;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use App\Models\Product;
use App\Models\ShoppingCart;

class ProductDetail extends Component
{

    public $selectedQuantity = 1;
    public $product;
    public $cartMessage = '';

    public function mount($product)
    {
        $this->product = $product;
    }


    public function decrementQuantity()
    {
        if ($this->selectedQuantity > 1) {
            $this->selectedQuantity--;
        }
    }

    public function incrementQuantity()
    {
        if ($this->selectedQuantity < $this->product->quantity) {
            $this->selectedQuantity++;
        }
    }

    public function addToCart()
    {
        $this->validate([
            'selectedQuantity' => 'required|numeric|min:1',
        ]);

        $existingCartItem = ShoppingCart::where('user_id', auth()->user()->id)
            ->where('product_id', $this->product->id)
            ->first();

        $totalQuantityInCart = $existingCartItem ? $existingCartItem->quantity : 0;
        $totalQuantityInCart += $this->selectedQuantity;

        if ($totalQuantityInCart <= $this->product->quantity) {
            if ($existingCartItem) {
                $existingCartItem->update([
                    'quantity' => $totalQuantityInCart,
                ]);
            } else {
                ShoppingCart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $this->product->id,
                    'quantity' => $this->selectedQuantity,
                ]);
            }
            MostAddedToCartProduct::create([
                'product_id' => $this->product->id,
                'user_id' => auth()->id(),
            ]);
            $this->selectedQuantity = 1;
            $this->cartMessage = 'Item added to cart successfully.';
            $this->emit('cartUpdated', 'Item added to cart successfully.');
            $this->emit('updateCartCount');
        } else {
            $this->emit('cartUpdated', 'Selected quantity exceeds available stock.');
            $this->cartMessage = 'Selected quantity exceeds available stock.';
            $this->selectedQuantity = 1;
        }
    }

    public function buyNow()
    {
        $this->validate([
            'selectedQuantity' => 'required|numeric|min:1',
        ]);

        $product = Product::findOrFail($this->product->id);

        if ($product->quantity > 0) {
            return redirect()->route('users.checkout')->with([
                'product' => $product->toArray(),
                'selectedQuantity' => $this->selectedQuantity,
            ]);
        } else {
            return redirect()->route('product.index')->with('error', 'Product is out of stock.');
        }
    }


    public function render()
    {

        return view('livewire.product-detail', [
            'product' => $this->product,
        ]);
    }
}
