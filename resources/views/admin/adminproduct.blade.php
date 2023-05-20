<!-- resources/views/products/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-x-auto shadow-xl sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Products</h1>
        <div x-data="{ openCreateProductPopup: false }">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block" x-on:click.prevent="openCreateProductPopup = true">Create Product</a>
            <!--Popup-->
            <div x-show="openCreateProductPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div @click.away="openCreateProductPopup = false" class="bg-white max-w-lg mx-auto rounded shadow-lg p-6">
                   <div class="popup-content">
                      <h2 class="text-lg font-bold mb-4">Create Product</h2>
                      <form @submit.prevent="submitCreateProductForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                         <div>
                            <label for="name">Product Name:</label>
                            <input type="text" id="name" name="name" class="border border-gray-300 rounded-md p-2" required>
                         </div>
                         <div class="mt-4">
                            <label for="description" class="pr-5">Description:</label>
                            <textarea id="description" name="description" class="border border-gray-300 rounded-md p-2" required></textarea>
                         </div>
                         <div class="mt-4">
                            <label for="price" class="pr-16">Price:</label>
                            <input type="number" id="price" name="price" class="border border-gray-300 rounded-md p-2" required>
                         </div>
                         <div class="mt-4 relative flex">
                            <label for="image" class="pr-14">Image:</label>
                            <input type="file" id="image" name="image" class="border border-gray-300 rounded-md p-2" required>
                        </div>
                         <div class="mt-4">
                             <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="openCreateProductPopup = false">Cancel</button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Product</button>
                         </div>
                      </form>
                   </div>
                </div>
             </div>
          
             <!-- Success message -->
             @if (session('success'))
             <div class="bg-green-200 text-green-800 rounded p-4 mb-4">{{ session('success') }}</div>
             @endif
        </div>
        
        
        
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="border px-4 py-2">{{ $product->name }}</td>
                        <td class="border px-4 py-2">{{ $product->description }}</td>
                        <td class="border px-4 py-2">{{ $product->price }}</td>
                        <td class="border px-4 py-2">
                            <img src="{{ asset('../storage/images/'.$product->image) }}" alt="Product Image" width="100px" height="100px">
                        </td>
                        <td class="border px-4 py-10 flex space-x-3">
                            <div class="mt-1" x-data="{ openEditProductPopup: false, product: {{  json_encode($product) }}}">
                                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2 rounded" x-on:click.prevent="openEditProductPopup = true;">Edit Product</a>
                                <!-- Popup -->
                                <div x-show="openEditProductPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                    <div @click.away="openEditProductPopup = false" class="bg-white max-w-lg mx-auto rounded shadow-lg p-6">
                                        <div class="popup-content">
                                         <h2 class="text-lg font-bold mb-4">Edit User</h2>
                                         <form @submit.prevent="updateEditProductPopup({{ $product->id }})" action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" :value="product.id">
                                            <div class="mt-4">
                                               <label for="editProductName">Name:</label>
                                               <input type="text" :id="'editProductName-' + product.id" :name="'editProductName-' + product.id" :value="product.name" class="border border-gray-300 rounded-md p-2">
                                            </div>
                                            <div class="mt-4">
                                               <label for="editProductDescription">Description:</label>
                                               <textarea type="description" :id="'editProductDescription-' + product.id" :name="'editProductDescription-' + product.id" :value="product.description" class="border border-gray-300 rounded-md p-2"></textarea>
                                            </div>
                                            <div class="mt-4">
                                                <label for="editProductPrice">Price:</label>
                                                <input type="number" :id="'editProductPrice-' + product.id" :name="'editProductName-' + product.id" :value="product.price" class="border border-gray-300 rounded-md p-2">
                                             </div>
                                             <div class="mt-4 relative flex">
                                                <label for="editProductImage" class="pr-14">Image:</label>
                                                <input type="file" :id="'editProductImage-' + product.id" :name="'editProductImage-' + product.id" class="border border-gray-300 rounded-md p-2" required>                                                
                                            </div>

                                           
                                            <div class="mt-4">
                                                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" @click="openEditProductPopup = false">Cancel</button>
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Update Product</button>
                                            </div>
                                         </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>



                            <form action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>
    
</x-app-layout>
