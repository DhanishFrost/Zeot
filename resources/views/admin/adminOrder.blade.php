<x-guest-layout>
    <header>
        <h1 class="font-[poppins] text-2xl font-semibold text-center mb-8 pt-12 bg-white">Manage Orders</h1>
    </header>
    <main>
        <div class="lg:flex">
            <div class="lg:w-64 bg-white lg:h-screen top-0 left-0 border-r lg:fixed">
                @livewire('admin-sidebar')
            </div>

            <div class="lg:flex-1 bg-gray-100 ">
                <div class="max-w-8xl lg:ml-64 mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white lg:mt-12 overflow-x-auto shadow-xl sm:rounded-lg p-6">
                        <h1 class="text-2xl font-bold mb-4">Orders</h1>
                        @livewire('admin-order-management')
                    </div>
                </div>
            </div>

        </div>
    </main>
</x-guest-layout>
