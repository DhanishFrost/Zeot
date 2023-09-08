<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearchAndFilter extends Component
{
    public $search = '';
    public $categoryFilter = '';
    public $quantityFilter = '';
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $perPage = 12;
    public $currentPage = 1;
    public $openEditProductPopup = [];

    public function mount()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $this->openEditProductPopup[$product->id] = false;
        }
    }

    public function render()
    {
        $query = Product::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $this->search . '%');
            });
        }

        if ($this->categoryFilter) {
            $query->where('category', $this->categoryFilter);
        }

        if ($this->quantityFilter !== '') {
            if ($this->quantityFilter == '1') {
                $query->where('quantity', '>', 0);
            } elseif ($this->quantityFilter == '0') {
                $query->where('quantity', '=', 0);
            }
        }

        if ($this->sortBy == 'price') {
            $query->orderBy('price', $this->sortDirection);
        } else {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        $filteredProducts = $query->paginate($this->perPage, ['*'], 'page', $this->currentPage);


        return view('livewire.product-search-and-filter', [
            'filteredProducts' => $filteredProducts,
        ]);
    }
}
