@extends('layouts.sidebar')
@section('content')
    <div class="flex flex-col max-w-sm bg-white dark:bg-gray-800 shadow-sm rounded-xl">
        <div class="px-5 pt-5">
            <header class="flex justify-between items-start mb-2">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Employee Statistics</h2>
            </header>
            <div class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase mb-1">Total Employees</div>
            <div class="flex items-start mb-4">
                <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mr-2">{{ $totalEmployees }}</div>
            </div>
        </div>

        
    </div>
    <div class="flex flex-col max-w-sm bg-white dark:bg-gray-800 shadow-sm rounded-xl mt-4">
        <div class="px-5 pt-5">
            <header class="flex justify-between items-start mb-2">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Vacation Statistics</h2>
            </header>
            <div class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase mb-1">Approved Vacations</div>
            <div class="flex items-start mb-2">
                <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mr-2">{{ $approvedVacations }}</div>
            </div>
            <div class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase mb-1">Rejected Vacations</div>
            <div class="flex items-start mb-2">
                <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mr-2">{{ $rejectedVacations }}</div>
            </div>
            <div class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase mb-1">Pending Vacations</div>
            <div class="flex items-start mb-4">
                <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mr-2">{{ $pendingVacations }}</div>
            </div>
        </div>
        <div class="grow max-sm:max-h-[128px] xl:max-h-[128px]">
            <canvas id="vacation-statistics-chart" width="389" height="128"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk grafik cuti
        const vacationCtx = document.getElementById('vacation-statistics-chart').getContext('2d');
        const vacationChart = new Chart(vacationCtx, {
            type: 'doughnut',
            data: {
                labels: ['Approved', 'Rejected', 'Pending'],
                datasets: [{
                    label: 'Vacation Status',
                    data: [{{ $approvedVacations }}, {{ $rejectedVacations }}, {{ $pendingVacations }}],
                    backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        });
    </script>
    </div>  
@endsection
