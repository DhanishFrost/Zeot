<div class="grid grid-cols-4 gap-4 max-lg:grid-cols-1">
    <section class="shadow rounded-lg px-8 "><br><br>
        <h1 class="font-[poppins] text-lg font-bold">FILTER</h1>
        <div class="pb-16 pt-4 pl-7 mt-2">
            <h1 class="font-[poppins] font-semibold text-md mb-2">Search</h1>
            <input type="text" wire:model="search"
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-11/12"
                placeholder="Search...">
            <br><br>
            <div class="relative pr-6 mb-4">
                <div class="flex flex-col">
                    <span class="font-[poppins] font-semibold text-md mb-2">Category:</span>
                    <select wire:model="categoryFilter" class="border border-gray-300 rounded-md">
                        <option value="">All</option>
                        <option value="mens">Men's Watches</option>
                        <option value="womens">Women's Watches</option>
                        <option value="unisex">Unisex</option>
                    </select>
                </div>
            </div>
            

            <div class="relative pr-6 mb-4">
                <div class="flex flex-col">
                    <span class="font-[poppins] font-semibold text-md mb-2">Sort:</span>
                    <select wire:model="sortBy" class="border border-gray-300 rounded-md">
                        <option value="id">Default Sorting</option>
                        <option value="name">Sort by Name</option>
                        <option value="price">Sort by Price</option>
                    </select>
                </div>
            </div>
            <div class="relative pr-6 mb-4">
                <div class="flex flex-col">
                <span class="font-[poppins] font-semibold text-md mb-2">Order</span>
                <select wire:model="sortDirection" class="border border-gray-300 rounded-md">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            </div>
            <div class="relative pr-6 mb-4">
                <div class="flex flex-col">
                <label for="brand" class="font-[poppins] font-semibold text-md mb-2">Brand:</label>
                <input type="text" wire:model="brandFilter" id="brand" name="brand"
                    class="border border-gray-300 rounded-md p-2" required>
                </div>
            </div>

            <div class="relative pr-6 mb-4">
                <div class="flex flex-col ">
                    <span class="font-[poppins] font-semibold text-md mb-2">Stock:</span>
                    <select wire:model="quantityFilter" class="border border-gray-300 rounded-md p-2 pr-8">
                        <option value="">All</option>
                        <option value="1">In Stock</option>
                        <option value="0">Out of Stock</option>
                    </select>
                </div>
            </div>

            <div class="relative pr-6 mb-4">
                <div class="flex flex-col">
                    <span class="font-[poppins] font-semibold text-md mb-2">Price Range</span>
                    <div class="flex space-x-2">
                        <input type="number" wire:model="minPrice" class="border border-gray-300 rounded-md p-2 w-28"
                            placeholder="Min">
                        <input type="number" wire:model="maxPrice" class="border border-gray-300 rounded-md p-2 w-28"
                            placeholder="Max">
                        <button wire:click="clearPriceFilter" class="border border-gray-300 text-gray-700 px-2 rounded-md ml-2 hover:bg-gray-300">Clear</button>
                    </div>
                </div>
            </div>

            
        </div>
    </section>

    <section class="col-span-3 max-lg:col-span-1">
        <h1 class="font-[poppins] tracking-wider font-semibold text-3xl text-center">Products</h1><br>
        <div class="grid grid-cols-3 gap-4 max-lg:grid-cols-1 mt-4">
            @if ($filteredProducts->isEmpty())
                <p class="text-center text-gray-500">No products found with the selected filters.</p>
            @else
                @foreach ($filteredProducts as $product)
                    <div class="p-4">
                        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="block">
                            @if ($product->image)
                                <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image"
                                    class="rounded-md ease-in-out hover:opacity-80 delay-200 h-96 w-80 object-cover">
                            @endif
                            <div>
                                <p class="font-[poppins] text-lg font-medium mt-2 max-sm:ml-auto">{{ $product->name }}</p>
                                <p class="font-[poppins] text-lg font-medium text-gray-500 mt-1 max-sm:ml-auto">LKR
                                    {{ number_format($product->price) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
    
</div>
