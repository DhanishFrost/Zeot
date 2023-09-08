<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

class ProductMetrics extends Component
{
    public $bestSellingProducts;
    public $mostViewedProducts;
    public $mostAddedToCartProducts;
    public $mostAbandonedProducts;
    public $cartAbandonmentRate;

    public function mount()
    {
        $this->getBestSellingProducts();
        $this->mostViewProducts();
        $this->mostAddedToCartProducts();
        $this->mostAbandonedProducts();
        $this->cartAbandonmentRate();
    }

    // Best selling products
    public function getBestSellingProducts()
    {
        $topSellingProducts = DB::table('order_items as oi')
            ->join('products as p', 'oi.product_id', '=', 'p.id')
            ->select('p.id', 'p.name', 'p.price', DB::raw('SUM(oi.quantity) as total_quantity_sold'))
            ->groupBy('p.id', 'p.name', 'p.price')
            ->orderByDesc('total_quantity_sold')
            ->take(5)
            ->get();


        $this->bestSellingProducts = $topSellingProducts;
    }


    // Most clicked products
    public function mostViewProducts()
    {
        $mostViewedProducts = DB::table('product_views as pv')
            ->join('products as p', 'pv.product_id', '=', 'p.id')
            ->select('p.id', 'p.name', 'p.price', DB::raw('COUNT(pv.product_id) as total_views'))
            ->groupBy('p.id', 'p.name', 'p.price')
            ->orderByDesc('total_views')
            ->take(5)
            ->get();

        $this->mostViewedProducts = $mostViewedProducts;
    }


    // Most added to cart products

    public function mostAddedToCartProducts()
    {
        $mostAddedToCartProducts = DB::table('most_added_to_cart_products as macp')
            ->join('products as p', 'macp.product_id', '=', 'p.id')
            ->select('p.id', 'p.name', 'p.price', DB::raw('COUNT(macp.product_id) as total_added_to_cart'))
            ->groupBy('p.id', 'p.name', 'p.price')
            ->orderByDesc('total_added_to_cart')
            ->take(5)
            ->get();

        $this->mostAddedToCartProducts = $mostAddedToCartProducts;
    }

    // Most abandoned products

    public function mostAbandonedProducts()
    {
        $mostAbandonedProducts = DB::table('abandoned_products as map')
            ->join('products as p', 'map.product_id', '=', 'p.id')
            ->select('p.id', 'p.name', 'p.price', DB::raw('COUNT(map.product_id) as total_abandoned'))
            ->groupBy('p.id', 'p.name', 'p.price')
            ->orderByDesc('total_abandoned')
            ->take(5)
            ->get();

        $this->mostAbandonedProducts = $mostAbandonedProducts;
    }

    // Cart Abandonment Rate
    public function cartAbandonmentRate()
    {
        $totalAbandoned = DB::table('abandoned_products')->count();
        $totalAddedToCart = DB::table('most_added_to_cart_products')->count();

        $this->cartAbandonmentRate = ($totalAbandoned / $totalAddedToCart) * 100;

    }


    public function render()
    {
        return view('livewire.product-metrics');
    }
}
