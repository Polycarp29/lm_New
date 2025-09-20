<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Lee Marketing Services Tasks Portal' }}</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('styles')
</head>

<body>

    <div class="flex h-screen bg-gray-100">
        @livewire('components.dashboard-side-bar')
        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">Dashboard</h1>
                @php
                    $username = Auth::user();
                @endphp
                <span class="text-sm text-gray-600 font-bold">Welcome, {{ $username->name }}</span>
            </header>
            {{ $slot }}
        </div>
    </div>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Heroicons & Alpine.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/heroicons@2.0.13/24/outline/index.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('showToast', event => {
                console.log("Toast event received:", event.detail); // Debugging line

                let message = event.detail?.message || "Something went wrong";
                let type = event.detail?.type || "error";

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: type,
                    title: message,
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        });
    </script>
</body>

</html>
