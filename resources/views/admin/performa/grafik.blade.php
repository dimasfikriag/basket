@extends('layouts.app')

@section('content')
    <h1 class="page-title">Grafik Perkembangan Performa Pemain</h1>

    <form method="GET" action="{{ route('admin.performa.grafik') }}" style="margin-bottom: 20px;">
        <div class="form-group">
            <label>Pilih Pemain</label>
            <select name="pemain_id" onchange="this.form.submit()">
                <option value="">-- Pilih Pemain --</option>
                @foreach($pemains as $pemain)
                    <option value="{{ $pemain->id }}" {{ $selectedPemain == $pemain->id ? 'selected' : '' }}>
                        {{ $pemain->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if($selectedPemain && count($labels) > 0)
        <div style="background:white; padding:20px; border-radius:10px;">
            <canvas id="grafikPerforma" height="100"></canvas>
        </div>
    @elseif($selectedPemain)
        <p class="text-muted">Belum ada data performa untuk pemain ini.</p>
    @else
        <p class="text-muted">Silakan pilih pemain untuk melihat grafik perkembangan performa.</p>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @if($selectedPemain && count($labels) > 0)
        <script>
            const ctx = document.getElementById('grafikPerforma').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Rata-rata Nilai Performa',
                        data: @json($data),
                        borderWidth: 2,
                        fill: false,
                        tension: 0
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