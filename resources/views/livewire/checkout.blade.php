<div class="lg:mt-8">
    <div class="grid grid-cols-4 gap-3 max-lg:grid-cols-none">
        <div class="bg-white rounded-md p-4 col-span-3">
            <h2>Select Delivery Address:</h2>
            @livewire('checkout-address')
        </div>
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
            <button wire:click="placeOrder"
                class="bg-red-500 text-white mt-16 w-72 py-2 rounded-md hover:bg-red-600">Place
                Order</button>
        </div>
        <div class="bg-white rounded-md p-4 col-span-3">
            <img class="w-16 mb-3" alt="logo" src="{{ asset('../images/Zeot.png') }}">
            <ul>
                @foreach ($selectedProducts as $product)
                    <li class="flex mt-4 justify-between">
                        <div class="flex">
                            <div class="w-16 h-16">
                                <img alt="Product" class="w-full h-full object-cover rounded-sm border border-gray-300"
                                    src="{{ asset('storage/images/' . $product['image']) }}">
                            </div>
                            <div class="my-auto ml-2">
                                <h3>{{ $product['name'] }}</h3>
                                <p>{{ $product['brand'] }}, {{ $product['category'] }}</p>
                            </div>
                        </div>
                        <div class="my-auto flex">
                            <p>Quantity: {{ $userSelectedQuantity }}</p>
                        </div>
                        <p class="my-auto">LKR {{ $product['price'] }}</p>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
    {{-- No Items selected modal --}}
    <div x-data="{ isOpen: false }" x-init="() => {
        @this.on('show-no-address-selected-popup', () => {
            isOpen = true;
            setTimeout(() => { isOpen = false; }, 1500); // Close after 2 seconds
        });
    }" x-show="isOpen"
        class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-25 bg-gray-800 pointer-events-none">
        <div class="bg-white p-4 rounded-md pointer-events-auto">
            <p>Please select an address or create one.</p>
        </div>
    </div>
</div>
