<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class UserOrderHistory extends Component
{
    public $orders;
    public $search = '';
    public $statusFilter = '';
    public $dateFilter = '';
    public $perPage = 12;
    public $currentPage = 1;

    public function mount()
    {
        $this->orders = Order::with(['user', 'userAddress', 'orderItems'])->get();
    }


    public function filterByStatus($status)
    {
        $this->statusFilter = $status;
    }

    public function render()
    {
        $query = Order::where('user_id', auth()->id());

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('user_id', 'like', '%' . $this->search . '%')
                    ->orWhere('total_price', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($subquery) {
                        $subquery->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('orderItems.product', function ($subquery) {
                        $subquery->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->statusFilter) {
            $query->whereHas('orderItems', function ($subquery) {
                $subquery->where('status', $this->statusFilter);
            });
        }

        if ($this->dateFilter) {
            $date = now()->subMonths($this->dateFilter);
            $query->where('created_at', '>=', $date);
        }


        $filteredOrders = $query->paginate($this->perPage, ['*'], 'page', $this->currentPage);

        return view('livewire.user-order-history', [
            'filteredOrders' => $filteredOrders,
        ]);
    }
}
