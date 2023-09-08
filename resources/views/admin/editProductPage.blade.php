<x-guest-layout>
    <div>
        <h1 class="font-[poppins] text-2xl font-semibold text-center pt-6 bg-white">Edit Products</h1>        <div class="container m-auto px-6 py-6 flex-1">
            @livewire('edit-product', ['product' => $product])
        </div>
    </div>
</x-guest-layout>
