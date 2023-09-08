<x-guest-layout>
    <div class="flex flex-col min-h-screen bg-gray-100">
        <header class="shadow">
            <x-userNavigation />
        </header>

        <br><br>
        <main class="md:mx-24 flex-grow">
            <div class="flex flex-col items-center justify-center h-full">
                <p class="text-2xl font-semibold text-gray-800 mb-4 mt-16">Order Placed Successfully</p>
                <p class="text-lg text-gray-600 text-center mb-8">Check your order history for more details</p>
                <a href="{{ route('product.userProduct') }}"
                    class="inline-block px-6 py-3 bg-cyan-800 text-white rounded-md hover:bg-cyan-600 transition-colors ease-in-out duration-300">Continue
                    Shopping</a>
                <a href="{{ route('users.orderHistory') }}"
                    class="inline-block px-6 py-3 mt-3 bg-cyan-800 text-white rounded-md hover:bg-cyan-600 transition-colors ease-in-out duration-300">View Order
                    History</a>

            </div>
        </main>
        

        <footer class="mt-10">
            <x-footer />
        </footer>
    </div>
</x-guest-layout>
