<div class="lg:mx-24">
    <div class="lg:grid lg:grid-cols-4 lg:gap-2">
        <div class="lg:col-span-3">
            <h2 class="text-2xl font-semibold mb-4 mt-6">Your Cart</h2>
            @if ($cartItems->isNotEmpty())
                <div class="flex bg-white mb-2 rounded-md justify-between">
                    <div>
                        <label class="inline-flex items-center space-x-2 py-2 px-6">
                            <input class="rounded-sm" type="checkbox" wire:click="toggleSelectAll">
                            <span>Select All</span>
                        </label>
                    </div>

                    <div class="mr-6 my-auto">
                        <button wire:click="confirmDeleteAll" class=" text-red-500 hover:text-red-700">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            @endif
            @if ($cartItems->isNotEmpty())
                <ul>
                    @foreach ($cartItems as $cartItem)
                        <li class="mb-4 lg:flex items-center space-x-4 justify-between bg-white px-6 py-5 rounded-md">
                            <div class="flex">
                                <div class="mr-2 my-auto">
                                    <label class="inline-flex items-center space-x-2">
                                        <input class="rounded-sm" type="checkbox"
                                            wire:model="selectedItems.{{ $cartItem->id }}"
                                            wire:click="calculateTotal()">
                                    </label>
                                </div>
                                <div class="w-24 h-24">
                                    <img alt="Product"
                                        class="w-full h-full object-cover rounded-lg border border-gray-300"
                                        src="{{ asset('storage/images/' . $cartItem->product->image) }}">
                                </div>
                                <div class="ml-6 my-auto">
                                    <p class="text-lg font-semibold">{{ $cartItem->product->name }}</p>
                                    <p>Brand: {{ $cartItem->product->brand }}, Category:
                                        @if ($cartItem->product->category === 'mens')
                                            Mens
                                        @elseif($cartItem->product->category === 'womens')
                                            Womens
                                        @else
                                            Unisex
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div>
                                <p>Price:</p>
                                <p class="text-lg">LKR {{ $cartItem->product->price }}</p>
                            </div>
                            <div class="flex">
                                <div>
                                    <div class="relative">
                                        <div class="flex items-center">
                                            <button wire:click="decrementQuantity({{ $cartItem->id }})"
                                                class="px-3 py-1 border mr-2 bg-gray-100 rounded-sm focus:outline-none">
                                                <i class="fa fa-minus text-gray-500"></i>
                                            </button>
                                            <span class="py-1 px-2">{{ $cartItem->quantity }}</span>
                                            <button wire:click="incrementQuantity({{ $cartItem->id }})"
                                                class="px-3 py-1 ml-2 border bg-gray-100 rounded-sm focus:outline-none">
                                                <i class="fa fa-add text-gray-500"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-6 my-auto">
                                    <button wire:click="confirmDelete({{ $cartItem->id }})"
                                        class="text-red-500 hover:text-red-700 focus:outline-none">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-lg text-center mt-6 md:ml-64">Your cart is empty.</p>
                <p class="text-center mt-6 md:ml-64"><a href="{{ route('product.userProduct') }}"
                        class="border rounded-md border-cyan-800 px-6 py-3 hover:bg-cyan-800 hover:text-white ease-in-out transition-all">Continue
                        Shopping</a></p>
            @endif
        </div>

        @if ($cartItems->isNotEmpty())
            <div class="col-span-1 mt-16 pt-2 max-lg:col-span-3 max-lg:mt-0">
                <div class="bg-white rounded-md p-4">
                    <p class="text-lg font-semibold">Order Summary</p>
                    <div class="flex justify-between mt-3">
                        <p class="text-md text-gray-500">Subtotal</p>
                        <p class="text-lg">LKR {{ $subtotal }}</p>
                    </div>
                    <hr class="mt-12">
                    <div class="flex justify-between mt-2">
                        <p class="text-md">Total</p>
                        <p class="text-lg">LKR {{ $total }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('users.checkout') }}"
                        class="bg-red-500 text-white mt-2 px-4 lg:pl-20 lg:pr-20 py-2 rounded-md hover:bg-red-600"
                        wire:click.prevent="proceedToCheckout">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        @endif
    </div>

    @if ($confirmingDeleteItem)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-800">
            <div class="bg-white p-4 rounded-md">
                <p>Are you sure you want to delete this Item?</p>
                <div class="flex justify-end mt-4">
                    <button wire:click="cancelDelete"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md mr-2">Cancel</button>
                    <button wire:click="deleteItem"
                        class="px-4 py-2 bg-red-500 text-white hover:bg-red-600 rounded-md">Delete</button>
                </div>
            </div>
        </div>
    @endif
    @if ($confirmingDeleteAll)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-800">
            <div class="bg-white p-4 rounded-md">
                <p>Are you sure you want to delete All the Items?</p>
                <div class="flex justify-end mt-4">
                    <button wire:click="cancelDeleteAll"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md mr-2">Cancel</button>
                    <button wire:click="deleteAllItem"
                        class="px-4 py-2 bg-red-500 text-white hover:bg-red-600 rounded-md">Delete</button>
                </div>
            </div>
        </div>
    @endif
    {{-- No Items selected modal --}}
    <div x-data="{ isOpen: false }" x-init="() => {
        @this.on('show-no-items-selected-popup', () => {
            isOpen = true;
            setTimeout(() => { isOpen = false; }, 1000); // Close after 2 seconds
        });
    }" x-show="isOpen"
        class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-25 bg-gray-800 pointer-events-none">
        <div class="bg-white p-4 rounded-md pointer-events-auto">
            <p>No item(s) selected.</p>
        </div>
    </div>




</div>
