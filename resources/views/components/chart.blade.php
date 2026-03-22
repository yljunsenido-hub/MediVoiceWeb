@props([
'title',
'labels' => [],
'data' => [],
'chartId',
'type' => 'line'
])

<div class="bg-white p-6 rounded-2xl shadow-lg w-full">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-800">
            {{ $title }}
        </h1>
    </div>

    <canvas id="{{ $chartId }}" class="w-full h-80"></canvas>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const labels = @json($labels);
        const data = @json($data);

        const ctx = document.getElementById('{{ $chartId }}');

        new Chart(ctx, {
            type: '{{ $type }}',
            data: {
                labels: labels,
                datasets: [{
                    label: '{{ $title }}',
                    data: data,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(59,130,246,0.2)',
                    borderColor: 'rgba(59,130,246,1)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    });
</script>