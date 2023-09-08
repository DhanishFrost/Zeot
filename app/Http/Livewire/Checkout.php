<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\RevenueMetric;
use App\Models\ShoppingCart;
use App\Models\userAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Checkout extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $total = 0;
    public $selectedProducts = [];
    public $userSelectedQuantity = 0;
    public $productId;
    protected $listeners = ['addressSelected', 'buyNow'];

    public function mount()
    {
        $selectedProducts = session()->get('selectedProducts', []);
        $buyNowProduct = session()->get('product', []);
        $buyNowSelectedQuantity = session()->get('selectedQuantity', []);

        $this->cartItems = [];
        $this->selectedProducts = [];

        foreach ($selectedProducts as $item) {
            $cartItem = [
                'id' => $item['id'],
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['product']['price'],
            ];

            $product = [
                'name' => $item['product']['name'],
                'description' => $item['product']['description'],
                'brand' => $item['product']['brand'],
                'category' => $item['product']['category'],
                'price' => $item['product']['price'],
                'image' => $item['product']['image'],
            ];

            $this->cartItems[] = $cartItem;
            $this->selectedProducts[] = $product;
            $this->userSelectedQuantity = $cartItem['quantity'];
            $this->productId = $cartItem['product_id'];
        }

        if (!empty($buyNowProduct)) {
            $product = [
                'name' => $buyNowProduct['name'],
                'description' => $buyNowProduct['description'],
                'brand' => $buyNowProduct['brand'],
                'category' => $buyNowProduct['category'],
                'price' => $buyNowProduct['price'],
                'image' => $buyNowProduct['image'],
            ];

            $this->cartItems[] = [
                'id' => null,
                'user_id' => Auth::id(),
                'product_id' => $buyNowProduct['id'],
                'quantity' => $buyNowSelectedQuantity,
                'price' => $buyNowProduct['price'],
            ];

            $this->selectedProducts[] = $product;
            $this->userSelectedQuantity = $buyNowSelectedQuantity;
            $this->productId = $buyNowProduct['id'];
        }

        $this->calculateSubTotal();
        $this->calculateTotal();
    }


    public function calculateSubtotal()
    {
        $this->subtotal = collect($this->selectedProducts)->sum(function ($product) {
            return $product['price'] * $this->userSelectedQuantity;
        });
    }


    public function calculateTotal()
    {
        $this->total = $this->subtotal;
    }

    public function placeOrder()
    {
        $selectedAddressData = session()->get('selectedAddressData', []);
        
        if (!empty($selectedAddressData)) {
            if (empty($this->selectedProducts)) {
                return redirect()->route('users.cart');
            }
            $order = Order::create([
                'user_id' => Auth::id(),
                'address_id' => $selectedAddressData['id'],
                'total_price' => $this->total,
            ]);

            $brands = [];
            $categories = [];
            $revenueMetrics = [];



            foreach ($this->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem['product_id'],
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['price'],
                    'status' => 'pending',
                ]);
                // Create a new revenue metric record
                $revenueMetric = new RevenueMetric([
                    'order_id' => $order->id,
                    'brand' => Product::find($cartItem['product_id'])->brand,
                    'category' => Product::find($cartItem['product_id'])->category,
                    'total_revenue' => $cartItem['price'], 
                    'date' => now(),
                ]);
                $revenueMetrics[] = $revenueMetric;
                $product = Product::find($cartItem['product_id']);
                $brands[] = $product->brand;
                $categories[] = $product->category;

                Product::where('id', $cartItem['product_id'])->decrement('quantity', $cartItem['quantity']);
                ShoppingCart::where('id', $cartItem['id'])->delete();
            }
           
            
            foreach ($revenueMetrics as $revenueMetric) {
                $revenueMetric->save();
            }

            session()->forget('selectedProducts');
            session()->forget('selectedAddressData');

            return redirect()->route('users.orderSuccess');
        } else {
            $this->emit('show-no-address-selected-popup');
        }
    }





    public function render()
    {
        return view('livewire.checkout');
    }
}
