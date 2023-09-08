<x-guest-layout>
    <div class="flex flex-col min-h-screen bg-gray-100">
        <header class="shadow">
            <x-userNavigation />
        </header>

        <br><br>
        <main class="mx-2 lg:mx-24 flex-grow">
            @livewire('cart')
        </main>

        <footer class="mt-10">
            <x-footer />
        </footer>
    </div>
</x-guest-layout>
