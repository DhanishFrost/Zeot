<x-guest-layout>
    <header>
        <h1 class="font-[poppins] text-2xl font-semibold text-center mb-8 pt-12 bg-white">Manage Addresses</h1>
    </header>
    <main>
        <div class="lg:flex">
            <div class="lg:w-64 bg-white lg:h-screen top-0 left-0 border-r lg:fixed">
                <x-userSidebar/>
            </div>

            <div class="flex-1 bg-gray-100 h-screen">
                @livewire('user-address-book')
            </div>

        </div>
    </main>

</x-guest-layout>
