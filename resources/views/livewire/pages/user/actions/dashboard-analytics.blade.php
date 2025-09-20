<div>
    <div class="py-6 flex flex-col lg:flex-row gap-6">
        <!-- Chart 1 -->
        <div class="w-full lg:w-1/2 p-4 bg-white rounded-xl shadow-md">
            <h2 class="text-sm font-semibold text-gray-900 mb-2">User Growth</h2>
            <div class="relative" style="height: 250px;">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>

        <!-- Chart 2 -->
        <div class="w-full lg:w-1/2 p-4 bg-white rounded-xl shadow-md">
            <h2 class="text-sm font-semibold text-gray-900 mb-2">Blog Quality Score</h2>
            <div class="relative" style="height: 250px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const userCtx = document.getElementById('userGrowthChart').getContext('2d');
        new Chart(userCtx, {
            type: 'line',
            data: {
                labels: @json(array_keys($monthlyPerformance)),
                datasets: [{
                    label: 'Average Monthly Perfomance Score',
                    data: @json(array_values($monthlyPerformance)),
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.2)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        const chartData = @json($blogPerformance);

        const labels = chartData.map(item => item.label);
        const fullTitles = chartData.map(item => item.full_title);
        const scores = chartData.map(item => item.score);

        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Performance Score',
                    data: scores,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const index = context[0].dataIndex;
                                return fullTitles[index]; // Full blog title in tooltip
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
