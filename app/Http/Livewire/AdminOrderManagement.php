<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class AdminOrderManagement extends Component
{
    public $orders;
    public $selectedStatus = [];
    public $search = '';
    public $statusFilter = '';
    public $dateFilter = '';
    public $perPage = 12;
    public $currentPage = 1;
    public $selectIdentifiers = [];

    public function mount()
    {
        $this->orders = Order::with(['user', 'userAddress', 'orderItems'])->get();

        foreach ($this->orders as $order) {
            foreach ($order->orderItems as $item) {
                $this->selectIdentifiers[$item->id] = uniqid();
            }
        }
    }

    public function updateItemStatus($itemId)
    {
        if (!empty($this->selectedStatus[$itemId])) {
            $orderItem = OrderItem::find($itemId);
            if ($orderItem) {
                $orderItem->status = $this->selectedStatus[$itemId];
                $orderItem->save();
            }
        }
        $this->selectedStatus[$itemId] = '';
    }

    public function filterByStatus($status)
    {
        $this->statusFilter = $status;
    }

    public function reinitializeSelect($itemId, $identifier)
    {
        $this->dispatchBrowserEvent('reinitializeSelect', [
            'itemId' => $itemId,
            'identifier' => $identifier,
        ]);
    }


    public function render()
    {
        $query = Order::query();

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


        return view('livewire.admin-order-management', [
            'filteredOrders' => $filteredOrders,
        ]);
    }
}
