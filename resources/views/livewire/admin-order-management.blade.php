<div class="container mx-auto px-4 py-2">
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

    <div class="flex justify-between items-center">
        <div class="flex mb-4">
            <button wire:click="filterByStatus('')"
                class="px-1 mx-6 py-1 {{ $statusFilter == '' ? ' border-b-2 border-blue-500 font-semibold text-blue-500 ' : 'bg-white' }}">All</button>
            <button wire:click="filterByStatus('pending')"
                class="px-1 ml-10 py-1 {{ $statusFilter == 'pending' ? ' border-b-2 border-yellow-500 font-semibold text-yellow-500 ' : 'bg-white' }}">Pending</button>
            <button wire:click="filterByStatus('processing')"
                class="px-1 ml-10 py-1 {{ $statusFilter == 'processing' ? ' border-b-2 border-cyan-500 font-semibold text-cyan-500  ' : 'bg-white' }}">Processing</button>
            <button wire:click="filterByStatus('completed')"
                class="px-1 ml-10 py-1 {{ $statusFilter == 'completed' ? ' border-b-2 border-green-500 font-semibold text-green-500  ' : 'bg-white' }}">Completed</button>
            <button wire:click="filterByStatus('declined')"
                class="px-1 ml-10 py-1 {{ $statusFilter == 'declined' ? ' border-b-2 border-red-500 font-semibold text-red-500 ' : 'bg-white' }}">Declined</button>
        </div>
    </div>

    @if ($orders !== null)
        <table class="min-w-full table-auto">
            <thead>
                <tr class="">
                    <th class="px-4 py-2">Order ID</th>
                    <th class="px-4 py-2">Customer ID</th>
                    <th class="px-4 py-2">Customer Name</th>
                    <th class="px-4 py-2">Customer Email</th>
                    <th class="px-4 py-2">Customer Mobile No.</th>
                    <th class="px-4 py-2">Customer Address</th>
                    <th class="px-4 py-2">Order Date</th>
                    <th class="px-4 py-2">Items</th>
                    <th class="px-4 py-2">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filteredOrders as $order)
                    <tr>
                        <td class="border px-4 py-2">{{ $order->id }}</td>
                        <td class="border px-4 py-2">{{ $order->user->id }}</td>
                        <td class="border px-4 py-2">{{ $order->user->name }}</td>
                        <td class="border px-4 py-2">{{ $order->user->email }}</td>
                        <td class="border px-4 py-2">(+94){{ $order->userAddress->phone }}</td>
                        <td class="border px-4 py-2">
                            @if ($order->userAddress)
                                {{ $order->userAddress->address }}
                            @else
                                Address not found
                            @endif
                        </td>

                        <td class="border px-4 py-2">{{ $order->created_at }}</td>
                        <td class="border px-4 py-2">
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
                                    <div class=" rounded-md mt-2 text-center">
                                        <select wire:model="selectedStatus.{{ $item->id }}"
                                            class="rounded-md p-2 pr-8 w-38" wire:ignore
                                            wire:init="reinitializeSelect('{{ $item->id }}', '{{ $selectIdentifiers[$item->id] }}')">
                                            <option value="">Update Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Processing">Processing</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Declined">Declined</option>
                                        </select>
                                    </div>
                                    <button
                                        class="mt-2 mx-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                        wire:click.prevent="updateItemStatus({{ $item->id }})" wire:ignore>
                                        Update Status
                                    </button>
                                </div>
                            @endforeach
                        </td>

                        <td class="border px-4 py-2">LKR {{ $order->total_price }}</td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    @else
        <p>No orders found.</p>
    @endif
</div>
