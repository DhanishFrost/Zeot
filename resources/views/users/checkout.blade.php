<x-guest-layout>
    <div class="flex flex-col min-h-screen bg-gray-100">
        <header class="shadow">
            <x-userNavigation />
        </header>

        <br><br>
        <main class="md:mx-48 mx-2 flex-grow">
            @livewire('checkout')
        </main>

        <footer class="mt-10">
            <x-footer />
        </footer>
    </div>

</x-guest-layout>