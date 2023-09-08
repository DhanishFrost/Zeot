<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class UserProductFilters extends Component
{
    use WithPagination;
    public $search = '';
    public $categoryFilter = '';
    public $brandFilter = '';
    public $quantityFilter = '';
    public $minPrice = null;
    public $maxPrice = null;
    public $sortBy = 'id';
    public $perPage = 12; 
    public $currentPage = 1; 
    public $sortDirection = 'asc';

    public function clearPriceFilter()
    {
        $this->currentPage = 1; 
        $this->minPrice = null; 
        $this->maxPrice = null; 
        $this->render(); 
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
        if ($this->brandFilter) {
            $query->where('brand', $this->brandFilter);
        }

        if ($this->quantityFilter === '1') {
            $query->where('quantity', '>', 0);
        } elseif ($this->quantityFilter === '0') {
            $query->where('quantity', 0);
        }

        if ($this->minPrice !== null || $this->maxPrice !== null) {
            if ($this->minPrice === null) {
                $query->where('price', '<=', $this->maxPrice);
            } elseif ($this->maxPrice === null) {
                $query->where('price', '>=', $this->minPrice);
            } else {
                $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
            }
        }
        
    
        $query->orderBy($this->sortBy, $this->sortDirection);

        $filteredProducts = $query->paginate($this->perPage, ['*'], 'page', $this->currentPage);

        return view('livewire.user-product-filters', [
            'filteredProducts' => $filteredProducts,
        ]);
    }
}