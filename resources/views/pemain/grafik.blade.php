@extends('layouts.app')

@section('content')
    <h1 class="page-title">Grafik Perkembangan Saya</h1>

    @if($pemain && count($labels) > 0)
        <div style="background:white; padding:20px; border-radius:10px;">
            <canvas id="grafikPemain" height="100"></canvas>
        </div>
    @elseif($pemain)
        <p class="text-muted">Belum ada data performa untuk ditampilkan.</p>
    @else
        <p class="text-muted">Data pemain belum terhubung ke akun ini.</p>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @if($pemain && count($labels) > 0)
        <script>
            const ctx = document.getElementById('grafikPemain').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Rata-rata Nilai Performa',
                        data: @json($data),
                        borderWidth: 3,
                        fill: false,
                        tension: 0.3,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 10
                        }
                    }
                }
            });
        </script>
    @endif
@endsection