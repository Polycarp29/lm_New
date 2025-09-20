<div class="flex">

    <!-- Main Content Area -->
    <div class="flex-1 p-6 bg-gray-50">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold text-gray-800">Tasks Page</h1>
            <button
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-semibold shadow">
                + Create Task
            </button>
        </div>

        <!-- Analytics Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Task Completion Rate Chart -->
            <div
                class="bg-white p-6 rounded-lg shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-2xl font-semibold mb-6 text-gray-800">Task Completion Rate</h3>
                <div class="relative w-full h-64">
                    <canvas id="completionRateChart" class="w-full h-full rounded-lg"></canvas>
                </div>
            </div>

            <!-- Performance Overview -->
            <div
                class="bg-white p-6 rounded-lg shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-2xl font-semibold mb-6 text-gray-800">Performance Overview</h3>
                <div class="relative w-full h-64">
                    <canvas id="trafficOverviewChart" class="w-full h-full rounded-lg"></canvas>
                </div>
            </div>

            <!-- Task Priorities -->
            <div
                class="bg-white p-6 rounded-lg shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-2xl font-semibold mb-6 text-gray-800">Task Priorities</h3>
                <div class="relative w-full h-64">
                    <canvas id="taskPriorityBarChart" class="w-full h-full rounded-lg"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart.js Script -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
           document.addEventListener('DOMContentLoaded', function () {
    fetch('/completion-rate-data')
        .then(response => response.json())
        .then(data => {
            const ctxCompletion = document.getElementById('completionRateChart').getContext('2d');
            const completionRateChart = new Chart(ctxCompletion, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Completion Rate (%)',
                        data: data.data,
                        backgroundColor: 'rgba(76, 175, 80, 0.7)',
                        borderColor: 'rgba(76, 175, 80, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)',
                            },
                            ticks: {
                                font: {
                                    family: 'Arial, sans-serif',
                                    size: 14
                                }
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    family: 'Arial, sans-serif',
                                    size: 14
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        }
                    }
                }
            });
        });
});

             // Blog Traffic Data (Line Chart)
    const blogTitles = [
        'Blog Post 1', 'Blog Post 2', 'Blog Post 3', 'Blog Post 4', 'Blog Post 5'
    ];

    const trafficData = [
        [150, 200, 250, 300, 350],  // Traffic data for Blog Post 1
        [100, 150, 200, 250, 300],  // Traffic data for Blog Post 2
        [50, 75, 100, 125, 150],    // Traffic data for Blog Post 3
        [200, 250, 300, 350, 400],  // Traffic data for Blog Post 4
        [300, 350, 400, 450, 500]   // Traffic data for Blog Post 5
    ];

    const ctxTraffic = document.getElementById('trafficOverviewChart').getContext('2d');
    const trafficOverviewChart = new Chart(ctxTraffic, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'], // Time periods
            datasets: blogTitles.map((title, index) => ({
                label: title,
                data: trafficData[index],
                borderColor: getRandomColor(),  // Random color for each blog
                backgroundColor: 'rgba(0, 0, 0, 0)',
                fill: false,
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }))
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                    },
                    ticks: {
                        font: {
                            family: 'Arial, sans-serif',
                            size: 14
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: 'Arial, sans-serif',
                            size: 14
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        title: function(tooltipItem) {
                            return tooltipItem[0].label; // Show the week as the title
                        },
                        label: function(tooltipItem) {
                            const blogIndex = tooltipItem.datasetIndex;
                            const traffic = tooltipItem.raw;
                            return `${blogTitles[blogIndex]}: ${traffic} views`; // Show blog title and traffic
                        }
                    }
                },
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });

    // Helper function to generate random colors
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    const taskNames = ['Task 1', 'Task 2', 'Task 3', 'Task 4', 'Task 5'];
    const taskPriorities = ['High', 'Medium', 'Low', 'High', 'Medium'];

    const taskPriorityCounts = {
        High: taskPriorities.filter(p => p === 'High').length,
        Medium: taskPriorities.filter(p => p === 'Medium').length,
        Low: taskPriorities.filter(p => p === 'Low').length,
    };

    const ctxPriorityBar = document.getElementById('taskPriorityBarChart').getContext('2d');
    const taskPriorityBarChart = new Chart(ctxPriorityBar, {
        type: 'bar',
        data: {
            labels: Object.keys(taskPriorityCounts),
            datasets: [{
                label: 'Task Priority Count',
                data: Object.values(taskPriorityCounts),
                backgroundColor: ['#F44336', '#FFEB3B', '#4CAF50'],
                borderColor: ['#F44336', '#FFEB3B', '#4CAF50'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' tasks'; // Display count on hover
                        }
                    }
                },
                legend: {
                    display: false
                }
            }
        }
    });
        </script>



        <!-- Running Tasks Table -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">

            <!-- Search and Filters -->
            <div class="flex flex-wrap gap-4 mb-6 items-end">
                <div class="flex-1">
                    <label class="block text-gray-700 text-sm mb-1">Search</label>
                    <input wire:model.live="search" type="text" placeholder="Search by keyword, title, category..."
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm mb-1">From (Created At)</label>
                    <input wire:model.live="filterDateFrom" type="date"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm mb-1">To (Created At)</label>
                    <input wire:model.live="filterDateTo" type="date"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm mb-1">Sort Order</label>
                    <select wire:model.live="sortOrder"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200">
                        <option value="desc">Newest First</option>
                        <option value="asc">Oldest First</option>
                    </select>
                </div>
            </div>

            <!-- Now your 3 tables separately -->
            @include('livewire.pages.user.actions.partials.running-tasks', ['tasks' => $runningTasks])
            @include('livewire.pages.user.actions.partials.completed-tasks', ['tasks' => $completedTasks])
            @include('livewire.pages.user.actions.partials.rejected-tasks', ['tasks' => $rejectedTasks])
        </div>
    </div>
</div>