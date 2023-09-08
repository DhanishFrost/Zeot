<div>
    <div class="flex pb-6 mt-4">
        <div class="relative pr-4 flex flex-col">
            <span class="text-sm text-gray-500 mb-1">Search</span>
            <input type="text" wire:model="search" class="border border-gray-300 rounded-md p-2" placeholder="Search...">
        </div>
        <div class="relative px-4 flex flex-col">
            <span class="text-sm text-gray-500 mb-1">Category</span>
            <select wire:model="categoryFilter" class="border border-gray-300 rounded-md p-2 pr-8">
                <option value="">All</option>
                <option value="mens">Mens</option>
                <option value="womens">Womens</option>
                <option value="Unisex">Unisex</option>
            </select>
        </div>
        <div class="relative px-4 flex flex-col">
                <span class="text-sm text-gray-500 mb-1">Stock</span>
                <select wire:model="quantityFilter" class="border border-gray-300 rounded-md p-2 pr-8">
                    <option value="">All</option>
                    <option value="1">In Stock</option>
                    <option value="0">Out of Stock</option>
                </select>
        </div>
        <div class="px-4 flex flex-col">
            <span class="text-sm text-gray-500 mb-1">Sorting</span>
            <select wire:model="sortBy" class="border border-gray-300 rounded-md p-2 pr-8">
                <option value="id">Default Sorting</option>
                <option value="name">Sort by Name</option>
                <option value="price">Sort by Price</option>
            </select>
        </div>
        <div class="px-4 flex flex-col">
            <span class="text-sm text-gray-500 mb-1">Order</span>
            <select wire:model="sortDirection" class="border border-gray-300 rounded-md p-2 pr-8">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>

    </div>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Brand</th>
                <th class="px-4 py-2">Quantity</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filteredProducts as $product)
                <tr wire:key="product-{{ $product->id }}">
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->description }}</td>
                    <td class="border px-4 py-2">{{ $product->brand }}</td>
                    <td class="border px-4 py-2">{{ $product->quantity }}</td>
                    <td class="border px-4 py-2">{{ $product->price }}</td>
                    <td class="border px-2 py-2">
                        <img src="{{ asset('../storage/images/' . $product->image) }}" alt="Product Image"
                            class="object-cover w-full h-full" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td class="border px-4 py-10 flex space-x-3">

                        <a href="{{ route('editProductPage', ['product' => $product]) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2 rounded">Edit
                            Product</a>
                        <form action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
