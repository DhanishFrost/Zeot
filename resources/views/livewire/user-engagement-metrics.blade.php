<div class="">
    <div wire:init="initialize" class="max-lg:m-2 p-4 bg-white rounded-lg shadow-lg">
        <p class="mt-2 text-4xl font-semibold">{{ number_format($totalNumberOfVisits) }}</p>
        <h1 class="text-md text-gray-500">User Visits</h1>
        <p>User Retention Rate: {{ number_format($retentionRate) }}%</p>

        <div class="mt-8">
            <canvas id="visitGraph" class="w-full h-64"></canvas>
        </div>

        <div class="mt-4">
            <label for="selectedPeriod" class="block font-medium text-gray-700">Select Period:</label>
            <select wire:model="selectedPeriod" wire:change="updateUserVisitGraphData" id="selectedPeriod"
                class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-opacity-50">
                <option value="last7days">Last 7 Days</option>
                <option value="last30days">Last 30 Days</option>
                <option value="last3months">Last 3 Months</option>
                <option value="last6months">Last 6 Months</option>
                <option value="last12months">Last 12 Months</option>
            </select>
        </div>
    </div>
</div>
<script>
    let visitChart;
    var ctx = document.getElementById('visitGraph').getContext('2d');

    // Function to destroy and reinitialize the chart
    function initializeChart(userVisitLabels, userVisitData) {
        if (visitChart) {
            visitChart.destroy(); // Destroy the existing chart if it exists
        }

    visitChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: userVisitLabels,
            datasets: [{
                label: 'Number of Visits',
                data: userVisitData,
                fill: true,
                backgroundColor: 'rgba(0, 0, 255, 0.2)', 
                borderColor: 'blue',
                borderWidth: 2,
                pointBackgroundColor: 'blue',
                pointRadius: 3,
            }],
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Date'
                    },
                    grid: {
                        display: false,
                    },
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Visits'
                    },
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
            },
            elements: {
                line: {
                    tension: 0.4,
                },
            },
        },
    });
}

    document.addEventListener('livewire:load', function() {
        initializeChart([], []);
    });

    Livewire.on('userVisitUpdateGraph', function(userVisitLabels, userVisitData) {
        initializeChart(userVisitLabels, userVisitData);
    });

    function updateUserVisitGraphData(userVisitLabels, userVisitData) {
        if (visitChart) {
            visitChart.data.labels = userVisitLabels;
            visitChart.data.datasets[0].data = userVisitData;
            visitChart.update();
        }
    }
</script>