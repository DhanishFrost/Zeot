<div class="ml-2">
    <div class="max-lg:ml-2 p-4 bg-white rounded-lg shadow-lg">
        <p class="mt-2 text-2xl font-semibold">Product Metrics</p>
        <div class="mt-6">
            <div>
                <p class="mb-2 text-xl font-semibold">Top 5 Best Sellers</p>
                <table class="w-full mt-2">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-gray-200">Name</th>
                            <th class="py-2 px-4 bg-gray-200">Price</th>
                            <th class="py-2 px-4 bg-gray-200">Total Quantity Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($bestSellingProducts == null)
                            <tr>
                                <td colspan="3" class="py-2 px-4 text-center">No products found.</td>
                            </tr>
                        @else
                            @foreach ($bestSellingProducts as $product)
                                <tr>
                                    <td class="py-2 px-4">{{ $product->name }}</td>
                                    <td class="py-2 px-4 text-center">{{ $product->price }}</td>
                                    <td class="py-2 px-4 text-center">{{ $product->total_quantity_sold }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <p class="mt-6 mb-2 text-xl font-semibold">Most Viewed products</p>
            <table class="w-full mt-2">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200">Name</th>
                        <th class="py-2 px-4 bg-gray-200">Price</th>
                        <th class="py-2 px-4 bg-gray-200">Total Views</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($mostViewedProducts == null)
                        <tr>
                            <td colspan="3" class="py-2 px-4 text-center">No products found.</td>
                        </tr>
                    @else
                        @foreach ($mostViewedProducts as $product)
                            <tr>
                                <td class="py-2 px-4">{{ $product->name }}</td>
                                <td class="py-2 px-4 text-center">{{ $product->price }}</td>
                                <td class="py-2 px-4 text-center">{{ $product->total_views }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="lg:flex mb-2">
        <div class="max-lg:ml-2 p-4 mt-2  bg-white rounded-lg shadow-lg">
            <p class="mt-2 text-xl font-semibold">Top 5 Most Added to Cart Products</p>
            <table class="w-full mt-2">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200">Name</th>
                        <th class="py-2 px-4 bg-gray-200">Price</th>
                        <th class="py-2 px-4 bg-gray-200">Total Added to Cart</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($mostAddedToCartProducts == null)
                        <tr>
                            <td colspan="3" class="py-2 px-4 text-center">No products found.</td>
                        </tr>
                    @else
                        @foreach ($mostAddedToCartProducts as $product)
                            <tr>
                                <td class="py-2 px-4">{{ $product->name }}</td>
                                <td class="py-2 px-4 text-center">{{ $product->price }}</td>
                                <td class="py-2 px-4 text-center">{{ $product->total_added_to_cart }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="p-4 mt-2 ml-2 bg-white rounded-lg shadow-lg">
            <p class="mt-2 text-xl font-semibold">Most Abandoned products</p>
            <p class="mt-2 text-md font-bold">Cart Abandonment Rate: {{ number_format($cartAbandonmentRate, 2) }}%</p>
            <table class="w-full mt-2">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200">Name</th>
                        <th class="py-2 px-4 bg-gray-200">Price</th>
                        <th class="py-2 px-4 bg-gray-200">Total Abandoned</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($mostAbandonedProducts == null)
                        <tr>
                            <td colspan="3" class="py-2 px-4 text-center">No products found.</td>
                        </tr>
                    @else
                        @foreach ($mostAbandonedProducts as $product)
                            <tr>
                                <td class="py-2 px-4">{{ $product->name }}</td>
                                <td class="py-2 px-4 text-center">{{ $product->price }}</td>
                                <td class="py-2 px-4 text-center">{{ $product->total_abandoned }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
</div>
