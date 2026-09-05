@extends('layouts.dashboard')

@section('title', 'Dashboard - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    <section class="welcome-panel">
        <div><p class="eyebrow">{{ now()->format('l, d F Y') }}</p><h2>Welcome back, {{ $user->name }}</h2></div>
        <span class="welcome-icon"><i class="bi bi-stars" aria-hidden="true"></i></span>
    </section>
</div>
@endsection

@section('scripts')
<script>
    const chartData = @json($chartData);
    new Chart(document.getElementById('transactionChart'), { type: 'line', data: { labels: chartData.labels, datasets: [{ data: chartData.values, borderColor: '#c9574b', backgroundColor: 'rgba(201, 87, 75, 0.12)', fill: true, tension: 0.4, pointRadius: 4, pointBackgroundColor: '#fff', pointBorderColor: '#c9574b', pointBorderWidth: 2 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: '#eee8df' }, ticks: { color: '#827b72' } }, x: { grid: { display: false }, ticks: { color: '#827b72' } } } } });
</script>
@endsection