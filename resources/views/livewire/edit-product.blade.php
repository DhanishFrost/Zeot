<div class="px-12 py-6 bg-white rounded-lg shadow-md">
    <form wire:submit.prevent="updateProduct" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name:</label>
            <input type="text" class="mt-1 form-input rounded-md w-full" wire:model="name" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea class="mt-1 form-textarea rounded-md w-full" rows="4" wire:model="description" required></textarea>
        </div>
        <div class="mb-4">
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand:</label>
            <input type="text" class="mt-1 form-input rounded-md w-full" wire:model="brand" required>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Category:</label>
            <select class="mt-1 form-select rounded-md w-full" wire:model="category" required>
                <option value="mens">Mens</option>
                <option value="womens">Womens</option>
                <option value="Unisex">Unisex</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity:</label>
            <input type="number" class="mt-1 form-input rounded-md w-full" wire:model="quantity" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
            <input type="number" class="mt-1 form-input rounded-md w-full" wire:model="price" required>
        </div>

        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image:</label>
            <div class="relative bg-gray-100 border border-dashed border-gray-400 rounded-md cursor-pointer">
                <label for="image" class="absolute inset-0 flex flex-col items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="mt-2 text-sm text-gray-100">Click or drag to add an image</span>
                </label>
                <input type="file" class="opacity-0 w-full h-full absolute inset-0 cursor-pointer" wire:model="image">
                @if ($image)
                    <div class="w-full h-40 overflow-hidden rounded-md">
                        <img src="{{ $image->temporaryUrl() }}" alt="Selected Image" class="object-cover w-full h-full ">
                    </div>
                @elseif ($product->image)
                    <div class="w-full h-40 overflow-hidden rounded-md">
                        <img src="{{ asset('storage/images/'.$product->image) }}" alt="Product Image" class="object-cover w-full h-full">
                    </div>
                @endif
            </div>
        </div>
        
        <div class="flex justify-between">
            <a href="{{ route('product.adminProduct') }}" class="text-blue-500 hover:underline pt-2">Back</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md">Update Product</button>
        </div>
    </form>
</div>
