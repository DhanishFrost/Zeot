<div class="container mx-auto px-4 py-2 overflow-auto">
    <div class="flex pb-6 mt-4">
        <div class="relative pr-4 flex flex-col">
            <span class="text-sm text-gray-500 mb-1">Search</span>
            <input type="text" wire:model="search" class="border border-gray-300 rounded-md p-2" placeholder="Search...">
        </div>
        <div class="relative px-4 flex flex-col">
            <span class="text-sm text-gray-500 mb-1">Show</span>
            <select wire:model="dateFilter" class="border border-gray-300 rounded-md p-2 pr-8">
                <option value="">All</option>
                <option value="1">Past Month</option>
                <option value="3">Past 3 Months</option>
                <option value="6">Past 6 Months</option>
                <option value="12">Past 12 Months</option>
            </select>
        </div>

    </div>

    <div class="lg:flex lg:justify-between lg:items-center">
        <div class="lg:flex mb-4">
            <button wire:click="filterByStatus('')"
                class="px-1 mx-6 py-1 {{ $statusFilter == '' ? ' border-b-2 border-blue-500 font-semibold text-blue-500 ' : 'bg-gray-100' }}">All</button>
            <button wire:click="filterByStatus('pending')"
                class="px-1 ml-10 py-1 {{ $statusFilter == 'pending' ? ' border-b-2 border-yellow-500 font-semibold text-yellow-500 ' : 'bg-gray-100' }}">Pending</button>
            <button wire:click="filterByStatus('processing')"
                class="px-1 ml-10 py-1 {{ $statusFilter == 'processing' ? ' border-b-2 border-cyan-500 font-semibold text-cyan-500  ' : 'bg-gray-100' }}">Processing</button>
            <button wire:click="filterByStatus('completed')"
                class="px-1 ml-10 py-1 {{ $statusFilter == 'completed' ? ' border-b-2 border-green-500 font-semibold text-green-500  ' : 'bg-gray-100' }}">Completed</button>
            <button wire:click="filterByStatus('declined')"
                class="px-1 md:ml-10 py-1 {{ $statusFilter == 'declined' ? ' border-b-2 border-red-500 font-semibold text-red-500 ' : 'bg-gray-100' }}">Declined</button>
        </div>
    </div>

    @if ($orders !== null)
    <table class="lg:min-w-full border-collapse">
        <tbody>
            @foreach ($filteredOrders as $order)
                <tr class="border-b-2 border-gray-200 bg-white">
                    <td class="px-4 py-2">{{ $order->user->name }}</td>
                    <td class="px-4 py-2">{{ $order->user->email }}</td>
                    <td class="px-4 py-2">(+94){{ $order->userAddress->phone }}</td>
                    <td class="px-4 py-2">
                        @if ($order->userAddress)
                            {{ $order->userAddress->address }}
                        @else
                            Address not found
                        @endif
                    </td>
    
                    <td class="px-4 py-2">{{ $order->created_at }}</td>
                    <td class="px-4 py-2">
                        @foreach ($order->orderItems as $item)
                            <div class="mb-2 border-b-2 border-gray-200 pb-2">
                                <p class="text-lg font-semibold">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                <p class="text-sm text-gray-500">Price: LKR {{ $item->price }}</p>
                                <div class="mt-1 mx-5">
                                    @if ($item->status == 'pending')
                                        <p class="text-sm text-white bg-yellow-500 rounded-md text-center">Pending
                                        </p>
                                    @elseif ($item->status == 'processing')
                                        <p class="text-sm text-white bg-cyan-500 rounded-md text-center">Processing
                                        </p>
                                    @elseif ($item->status == 'completed')
                                        <p class="text-sm text-white bg-green-500 rounded-md text-center">Completed
                                        </p>
                                    @else
                                        <p class="text-sm text-white bg-red-500 rounded-md text-center">Declined</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </td>
    
                    <td class="px-4 py-2">LKR {{ $order->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    @else
        <p>No orders found.</p>
    @endif
</div>
