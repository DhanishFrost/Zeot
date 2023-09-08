<x-guest-layout>
    <header>
        <h1 class="font-[poppins] text-2xl font-semibold text-center mb-8 pt-12 bg-white">Order History</h1>
    </header>
    <main>
        <div class="lg:flex">
            <div class="lg:w-64 bg-white lg:h-screen top-0 left-0 border-r lg:fixed">
                <x-userSidebar />
            </div>

            <div class="flex-1 bg-gray-100">
                <div class="max-w-8xl lg:ml-64 mx-auto sm:px-6 lg:px-8">
                    @livewire('user-order-history')
                </div>
            </div>

        </div>
    </main>

</x-guest-layout>
