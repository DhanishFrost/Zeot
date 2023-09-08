<x-guest-layout>
    <div>
        <header class="shadow">
            <x-userNavigation />
        </header>

        <br><br>
        <main class="mx-20 max-lg:ml-8">
            @livewire('product-detail', ['product' => $product])
        </main>
        <footer class="mt-10">
            <x-footer />
        </footer>
    </div>
    
</x-guest-layout>
