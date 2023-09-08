<section class="text-gray-700 body-font overflow-hidden bg-white">
    <div class="px-44 max-lg:px-8">
        <p class="py-2 px-4 rounded-md 
                  @if (!empty($cartMessage) && strpos($cartMessage, 'Selected quantity exceeds available stock') !== false) bg-red-200 text-black @elseif(!empty($cartMessage)) bg-green-200 text-black @endif"
            >
            {{ $cartMessage }}
        </p>
    </div>


    <div class="container px-5 pb-24 pt-8 mx-auto">
        <div class="lg:w-4/5 mx-auto flex flex-wrap">
            <img alt="ecommerce" class="w-96 h-96 object-cover object-center rounded border border-gray-200"
                src="{{ asset('storage/images/' . $product->image) }}">
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-2">{{ $product->name }}</h1>
                <div class="flex">
                    <h2 class="text-sm title-font text-gray-600 tracking-widest">Brand : {{ $product->brand }}</h2>
                    <div class="border-r border-gray-500 mx-2 h-5"></div>
                    <h2 class="text-sm title-font text-gray-600 tracking-widest">
                        Category :
                        @if ($product->category === 'mens')
                            Mens
                        @elseif($product->category === 'womens')
                            Womens
                        @else
                            Unisex
                        @endif
                    </h2>

                </div>
                <p class="leading-relaxed mt-4">{{ $product->description }}</p>
                <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                    <div class="flex items-center">
                        <span class="mr-3">Quantity</span>
                        <div class="relative">
                            <div class="flex items-center">
                                <button wire:click="decrementQuantity"
                                    class="px-3 py-1 border mr-2 bg-gray-100 rounded-sm focus:outline-none">
                                    <i class="fa fa-minus text-gray-500"></i>
                                </button>
                                <span class="py-1 px-2">{{ $selectedQuantity }}</span>
                                <button wire:click="incrementQuantity"
                                    class="px-3 py-1 ml-2 border bg-gray-100 rounded-sm focus:outline-none">
                                    <i class="fa fa-add text-gray-500"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                    <span class="ml-6 text-sm text-gray-500">
                        @if ($product->quantity === 0)
                            Out of Stock
                        @else
                            Available: {{ $product->quantity }}
                        @endif
                    </span>

                </div>
                <div class="md:flex items-center">
                    <span class="title-font font-medium text-2xl text-gray-900">LKR {{ number_format($product->price) }}</span>
                    <button wire:click="buyNow"
                        class="flex md:ml-12 text-white {{ $product->quantity === 0 ? ' bg-gray-300 cursor-not-allowed' : 'bg-gray-500' }} border-0 py-2 bg-red-500 px-6 focus:outline-none hover:bg-red-600 rounded"
                        {{ $product->quantity === 0 ? 'disabled' : '' }}>
                        Buy Now
                    </button>
                    <button wire:click="addToCart"
                        class="flex md:ml-4 max-md:mt-4 text-white {{ $product->quantity === 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-gray-500' }} border-0 py-2 bg-red-500 px-6 focus:outline-none hover:bg-red-600 rounded"
                        {{ $product->quantity === 0 ? 'disabled' : '' }}>
                        Add to Cart
                    </button>

                </div>
            </div>
        </div>
    </div>
</section>
