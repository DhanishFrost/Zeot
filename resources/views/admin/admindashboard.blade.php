<x-guest-layout>
    <header>
        <h1 class="font-[poppins] text-2xl font-semibold text-center mb-8 pt-12 bg-white">Dashboard</h1>
    </header>
    <main>
        <div class="lg:flex">
            <div class="lg:w-64 bg-white lg:h-screen top-0 left-0 border-r lg:fixed">
                @livewire('admin-sidebar')
            </div>

            <div class="flex-1 bg-gray-100">
                <div class="max-w-8xl lg:ml-64 mx-auto sm:px-6 lg:px-8">
                    <h1 class="text-3xl max-lg:text-center font-bold mb-4 mt-4">Analytics</h1>
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6">
                            <div>
                                @livewire('revenue-metrics')
                            </div>
                            <div class="lg:flex">
                                <div class="lg:flex-1">
                                    @livewire('user-engagement-metrics')
                                </div>
                                <div class="lg:flex-1">
                                    @livewire('product-metrics')
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        </div>
        </div>
    </main>
</x-guest-layout>
