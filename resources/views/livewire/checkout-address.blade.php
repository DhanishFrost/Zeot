<div>
    <div x-data="{ show: @entangle('showPopup') }" class="pt-4 pb-4">
        <button @click="show = true"
            class="flex border px-3 py-2 rounded-md border-cyan-800 hover:bg-cyan-800 hover:text-white">
            <i class="fa fa-add pr-2 pt-1"></i>
            <p>Add New Address</p>
        </button>
        <div x-show="show" class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-800">
            <div class="bg-white p-4 rounded-md">
                <!-- Popup content goes here -->
                <form wire:submit.prevent="submitForm">
                    <div class="container max-w-screen-lg mx-auto">
                        <div class="bg-white rounded shadow-lg p-4 px-4">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                <div class="text-gray-600 pr-12">
                                    <p class="font-medium text-lg">
                                        {{ $editingaddressId ? 'Edit Address' : 'Add New Address' }}</p>
                                    <p>Please fill out all the fields.</p>
                                </div>

                                <div class="lg:col-span-2">
                                    <div class="mb-4">
                                        <label for="fullName" class="block font-medium">Full Name:</label>
                                        <input type="text" wire:model="fullName" id="fullName" name="fullName"
                                            class="border rounded-md p-2 w-full">
                                        @error('fullName')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mobileNumber" class="block font-medium">Mobile Number:</label>
                                        <div class="flex items-center">
                                            <div class="border rounded-l-md p-2 w-16 flex items-center justify-center">
                                                +94
                                            </div>
                                            <input type="tel" wire:model="mobileNumber" id="mobileNumber"
                                                name="mobileNumber" class="border rounded-r-md p-2 w-full"
                                                maxlength="9">
                                        </div>
                                        @error('mobileNumber')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mb-4 col-span-3">
                                        <label for="city" class="block font-medium">City:</label>
                                        <input type="text" wire:model="city" id="city" name="city"
                                            class="border rounded-md p-2 w-full">
                                        @error('city')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4 col-span-2">
                                        <label for="area" class="block font-medium">Area:</label>
                                        <input type="text" wire:model="area" id="area" name="area"
                                            class="border rounded-md p-2 w-full">
                                        @error('area')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="area" class="block font-medium">Address:</label>
                                        <input type="text" wire:model="address" id="area" name="area"
                                            class="border rounded-md p-2 w-full"
                                            placeholder="House no. / building / street / area">
                                        @error('address')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-medium mb-1">Address Type:</label>
                                        <div class="flex">
                                            <label class="">
                                                <input type="radio" wire:model="addressType" name="addressType"
                                                    value="home" class="hidden">
                                                <div
                                                    class="border-2 rounded-md p-2 px-12 cursor-pointer hover:border-cyan-700
                                                @if ($addressType === 'home') border-cyan-700 @else border-gray-300 @endif">
                                                    Home
                                                </div>
                                            </label>
                                            <label class="ml-2">
                                                <input type="radio" wire:model="addressType" name="addressType"
                                                    value="office" class="hidden">
                                                <div
                                                    class="border-2 rounded-md p-2 px-12 text-center cursor-pointer hover:border-cyan-700
                                                @if ($addressType === 'office') border-cyan-700 @else border-gray-300 @endif">
                                                    Office
                                                </div>
                                            </label>
                                        </div>
                                        @error('addressType')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="flex justify-end">
                                        <button @click="show = false; $wire.emit('resetFormFields')"
                                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md">Close</button>
                                        <button type="submit"
                                            class="ml-2 px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 rounded-md">{{ $editingaddressId ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="mr-12">
        @if ($addresses !== null)
            <div class="grid grid-cols-2 gap-6">
                @foreach ($addresses as $address)
                    <div class="border rounded-md shadow-md relative">
                        <!-- Radio button -->
                        <input type="radio" wire:model="selectedAddressId" value="{{ $address->id }}"
                            id="address_{{ $address->id }}"
                            class="form-radio absolute h-4 w-4 mt-2 ml-2 text-cyan-600">

                        <!-- Inside the foreach loop -->
                        <div class="absolute top-0 right-0 mt-2 mr-2">
                            <button wire:click="editAddress({{ $address->id }})"
                                class="text-gray-500 hover:text-gray-800"><i class="fas fa-edit"></i></button>
                            <button wire:click.prevent="confirmDelete({{ $address->id }})"
                                class="text-red-500 hover:text-red-800 ml-3"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="px-5 pb-5 pt-7">
                            <label for="address_{{ $address->id }}" class="block cursor-pointer"
                                wire:click="selectAddress({{ $address->id }})">
                                <p class="text-md pb-2">{{ $address->name }}</p>
                                <p class="text-md pb-2">(+94) {{ $address->phone }}</p>
                                <p class="text-md pb-2">{{ $address->city }}, {{ $address->area }} -
                                    {{ $address->address }}
                                </p>
                                <p class="text-sm text-cyan-700">{{ $address->address_type }}</p>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No addresses found. Please create an address</p>
        @endif


    </div>
    @if ($confirmingDelete)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-800">
            <div class="bg-white p-4 rounded-md">
                <p>Are you sure you want to delete this address?</p>
                <div class="flex justify-end mt-4">
                    <button wire:click="cancelDelete"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md mr-2">Cancel</button>
                    <button wire:click="deleteAddress"
                        class="px-4 py-2 bg-red-500 text-white hover:bg-red-600 rounded-md">Delete</button>
                </div>
            </div>
        </div>
    @endif


</div>
