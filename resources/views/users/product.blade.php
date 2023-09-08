<x-guest-layout>
    <div class="">
        <header class="shadow">
            <x-userNavigation/>
        </header>

        <br><br>
        <main class="mx-20 max-lg:ml-8">  
            @livewire('user-product-filters')
        </main>
        <footer class="mt-10">
            <x-footer/>
        </footer>
    </div>
</x-guest-layout>
