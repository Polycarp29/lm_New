<div class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-600 rounded-md my-4 mx-4">
    <h4 class="text-lg font-semibold">Total Payments for {{ $month }}</h4>
    <p class="text-xl font-bold text-green-600">{{ number_format($total, 2) }}</p>
</div>
