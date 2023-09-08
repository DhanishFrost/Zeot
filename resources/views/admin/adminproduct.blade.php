<x-guest-layout>
    <header>
        <h1 class="font-[poppins] text-2xl font-semibold text-center mb-8 pt-12 bg-white">Manage Products</h1>
    </header>
    <div class="lg:flex">
        <div class="lg:w-64 bg-white lg:h-screen top-0 left-0 border-r lg:fixed">
            @livewire('admin-sidebar')
        </div>
        <div class="lg:flex-1 lg:ml-12 max-lg:m-2 bg-gray-100">
            <div class="max-w-7xl lg:ml-72 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white mt-12 overflow-x-auto shadow-xl sm:rounded-lg p-6">
                    <h1 class="text-2xl font-bold mb-4">Products</h1>
                    <div x-data="{ openCreateProductPopup: false }">
                        <a href="#"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block"
                            x-on:click.prevent="openCreateProductPopup = true">Create Product</a>
                        
                        @if (session('success'))
                            <div class="bg-green-200 text-green-800 rounded p-4 mb-4">{{ session('success') }}</div>
                        @endif
                        {{-- livewire component --}}
                        @livewire('product-search-and-filter')    
                        <!--Popup-->
                        <div x-show="openCreateProductPopup"
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                            <div @click.away="openCreateProductPopup = false"
                                class="bg-white lg:max-w-lg lg:mx-auto rounded shadow-lg p-6">
                                <div class="popup-content">
                                    <h2 class="text-lg font-bold mb-4">Create Product</h2>
                                    <form @submit.prevent="submitCreateProductForm"
                                        action="{{ route('product.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        <div>
                                            <label for="name">Product Name:</label>
                                            <input type="text" id="name" name="name"
                                                class="border border-gray-300 rounded-md p-2" required>
                                        </div>
                                        <div class="mt-4">
                                            <label for="description" class="pr-5">Description:</label>
                                            <textarea id="description" name="description" class="border border-gray-300 rounded-md p-2" required></textarea>
                                        </div>
                                        <div class="mt-4">
                                            <label for="brand" class="pr-16">Brand:</label>
                                            <input type="text" id="brand" name="brand"
                                                class="border border-gray-300 rounded-md p-2"
                                                value="{{ old('brand', 'No Brand') }}" required>
                                        </div>                                        
                                        <div class="mt-4">
                                            <label for="category" class="pr-8">Category:</label>
                                            <select name="category" id="category"
                                                class="border border-gray-300 rounded-md p-2 pr-8" required>
                                                <option value="mens">Mens</option>
                                                <option value="womens">Womens</option>
                                                <option value="Unisex">Unisex</option>
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <label for="quantity" class="pr-8">Quantity:</label>
                                            <input type="number" id="quantity" name="quantity"
                                                class="border border-gray-300 rounded-md p-2" required>
                                        </div>
                                        <div class="mt-4">
                                            <label for="price" class="pr-16">Price:</label>
                                            <input type="number" id="price" name="price"
                                                class="border border-gray-300 rounded-md p-2" required>
                                        </div>
                                        <div class="mt-4 relative flex">
                                            <label for="image" class="pr-14">Image:</label>
                                            <input type="file" id="image" name="image"
                                                class="border border-gray-300 rounded-md p-2" required>
                                        </div>
                                        <div class="mt-4">
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                @click="openCreateProductPopup = false">Cancel</button>
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create
                                                Product</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                        
                    </div>            
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
