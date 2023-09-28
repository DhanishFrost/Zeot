<div class="lg:grid lg:grid-cols-6 lg:gap-2 max-lg:ml-2 mb-5">
    <div class="col-span-4 bg-white mt-8 overflow-x-auto shadow-xl rounded-lg p-6">
        <div wire:init="initialize">
            <div class="px-4 pb-4">
                <div class="flex justify-between">
                    <h2 class="text-xl font-semibold mb-4">Revenue Metrics</h2>
                    <div>
                        <select wire:model="selectedPeriod"
                            class="form-select focus:border-gray-100 border-none font-semibold text-gray-500"
                            wire:change="updateGraphData">
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="last7days">Last 7 Days</option>
                            <option value="last30days">Last 30 Days</option>
                            <option value="last3months">Last 3 Months</option>
                            <option value="last6months">Last 6 Months</option>
                            <option value="last12months">Last 12 Months</option>
                        </select>
                    </div>

                </div>
                <hr>
                <div class="mt-5 justify-between mb-3 lg:flex">
                    <div class="pr-5">
                        <p class="text-2xl max-lg:text-xl font-bold">LKR {{ number_format($this->totalRevenue(), 2) }}
                        </p>
                        <h2 class="text-md mb-2 text-gray-600">Total Revenue</h2>
                        <p class="text-lg max-lg:text-md font-semibold">LKR {{ $this->getAverageOrderValue() }}</p>
                        <h2 class="text-sm mb-2 text-gray-600">Average Order Value (AOV)</h2>
                    </div>
                    <p class="border lg:h-12 mt-3 mr-5"></p>
                    <div class="max-lg:mt-2">
                        <div class="flex">
                            <p class="text-2xl max-lg:text-xl font-bold">LKR
                                {{ number_format($this->revenueTrend('monthly'), 2) }}</p>
                            <p class="mt-1 ml-2">
                                @if ($this->revenueTrendPercentage('monthly') > 10)
                                    <span class="text-[#10b981]">+{{ $this->revenueTrendPercentage('monthly') }}%</span>
                                @elseif ($this->revenueTrendPercentage('monthly') >= 0)
                                    <span class="text-[#f6a50e]">+{{ $this->revenueTrendPercentage('monthly') }}%</span>
                                @else
                                    <span class="text-red-500">{{ $this->revenueTrendPercentage('monthly') }}%</span>
                                @endif
                            </p>
                        </div>
                        <h2 class="text-md mb-2 text-gray-600">Monthly Revenue</h2>
                    </div>
                    <p class="border lg:h-12 mt-3 mr-5"></p>
                    <div class="max-lg:mt-2">
                        <div class="flex">
                            <p class="text-2xl max-lg:text-xl font-bold">LKR
                                {{ number_format($this->revenueTrend('half-year'), 2) }}
                            </p>
                            <p class="mt-1 ml-2">
                                @if ($this->revenueTrendPercentage('half-year') > 10)
                                    <span
                                        class="text-[#10b981]">+{{ $this->revenueTrendPercentage('half-year') }}%</span>
                                @elseif ($this->revenueTrendPercentage('half-year') >= 0)
                                    <span
                                        class="text-[#f6a50e]">+{{ $this->revenueTrendPercentage('half-year') }}%</span>
                                @else
                                    <span class="text-red-500">{{ $this->revenueTrendPercentage('half-year') }}%</span>
                                @endif
                            </p>
                        </div>
                        <h2 class="text-md mb-2 text-gray-600">Last 6 Months</h2>
                    </div>
                </div>
                <canvas id="revenueTrendChart" class="w-full h-64"></canvas>
            </div>
        </div>
        <script>
            let chart; // Global chart variable

            document.addEventListener("livewire:load", function() {
                // Initial chart data
                const initialData = {
                    labels: [],
                    datasets: [{
                        label: 'Revenue Trend',
                        data: [],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: true,
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointRadius: 3,
                    }]
                };
                const ctx = document.getElementById('revenueTrendChart').getContext('2d');
                
                chart = new Chart(ctx, {
                    type: 'line',
                    data: initialData,
                    options: {
                        responsive: true,
                        scales: {
                            x: [{
                                type: 'time',
                                time: {
                                    unit: 'month'
                                },
                                grid: {
                                    display: false
                                },
                            }],
                            y: [{
                                beginAtZero: true,

                            }],
                        },
                        elements: {
                            line: {
                                tension: 0.4,
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    }
                });
            });

            Livewire.on('updateGraph', function(labels, data) {
                updateGraphData(labels, data);
            });

            // Function to update the chart data
            function updateGraphData(newLabels, newData) {
                if (chart) {
                    chart.data.labels = newLabels;
                    chart.data.datasets[0].data = newData;
                    chart.update();
                }
            }
        </script>


    </div>

    <div class="col-span-2 lg:mt-8 mt-4 flex">
        <div class="p-8 bg-white rounded-lg shadow-lg w-full">
            <h1 class="text-2xl font-semibold mb-4">Revenue Metrics</h1>

            <!-- Revenue by Category -->
            <div class="bg-gray-100 p-6 rounded-lg mb-6">
                <h2 class="text-xl font-semibold mb-2">Revenue by Category</h2>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Category</th>
                            <th class="text-right">Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revenueByCategory as $category)
                            <tr>
                                <td class="text-left capitalize">{{ $category->category }}</td>
                                <td class="text-right font-semibold">LKR
                                    {{ number_format($category->total_revenue, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Revenue by Brand -->
            <div class="bg-gray-100 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Revenue by Brand</h2>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Brand</th>
                            <th class="text-right">Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revenueByBrand as $brand)
                            <tr>
                                <td class="text-left">{{ $brand->brand }}</td>
                                <td class="text-right font-semibold">LKR {{ number_format($brand->total_revenue, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
