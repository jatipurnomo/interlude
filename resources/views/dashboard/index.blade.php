@extends('layouts.dashboard')

@section('title', 'Dashboard - Interlude')

@section('content')
<div class="container-fluid dashboard-container">
    <section class="welcome-panel">
        <div><p class="eyebrow">Thursday, 04 September 2026</p><h2>Welcome back, {{ $user->name }}</h2><p class="welcome-email mb-1">{{ $user->email }}</p><p class="mb-0">Here is what is happening across your publishing workspace today.</p></div>
        <span class="welcome-icon"><i class="bi bi-stars" aria-hidden="true"></i></span>
    </section>
    <section class="stats-grid" aria-label="Dashboard statistics">
        @foreach ($statistics as $statistic)
            <article class="stat-card"><div class="stat-card-header"><span>{{ $statistic['label'] }}</span><i class="bi bi-bar-chart-line" aria-hidden="true"></i></div><strong class="stat-value">{{ $statistic['value'] }}</strong><span class="stat-change {{ $statistic['trend'] === 'down' ? 'is-down' : '' }}"><i class="bi bi-arrow-{{ $statistic['trend'] }}" aria-hidden="true"></i>{{ $statistic['change'] }} from last month</span></article>
        @endforeach
    </section>
    <div class="dashboard-grid">
        <section class="dashboard-panel chart-panel"><div class="panel-heading"><div><p class="eyebrow mb-1">Performance</p><h2>Transaction Overview</h2></div><button class="period-button" type="button">Last 6 months <i class="bi bi-chevron-down" aria-hidden="true"></i></button></div><div class="chart-wrap"><canvas id="transactionChart" aria-label="Transaction overview chart" role="img"></canvas></div></section>
        <section class="dashboard-panel quick-panel"><div class="panel-heading"><div><p class="eyebrow mb-1">Shortcuts</p><h2>Quick Actions</h2></div><i class="bi bi-lightning-charge" aria-hidden="true"></i></div><div class="quick-actions"><a href="#" class="quick-action"><span class="quick-icon coral"><i class="bi bi-person-plus" aria-hidden="true"></i></span><span><strong>Add User</strong><small>Invite a teammate</small></span><i class="bi bi-arrow-up-right" aria-hidden="true"></i></a><a href="#" class="quick-action"><span class="quick-icon gold"><i class="bi bi-file-earmark-plus" aria-hidden="true"></i></span><span><strong>Create Report</strong><small>Turn data into insight</small></span><i class="bi bi-arrow-up-right" aria-hidden="true"></i></a><a href="#" class="quick-action"><span class="quick-icon teal"><i class="bi bi-folder2-open" aria-hidden="true"></i></span><span><strong>View Reports</strong><small>Browse your library</small></span><i class="bi bi-arrow-up-right" aria-hidden="true"></i></a></div></section>
    </div>
    <section class="dashboard-panel activity-panel"><div class="panel-heading"><div><p class="eyebrow mb-1">Latest updates</p><h2>Recent Activity</h2></div><a href="#" class="panel-link">View all <i class="bi bi-arrow-up-right" aria-hidden="true"></i></a></div><div class="table-responsive"><table class="table activity-table align-middle mb-0"><thead><tr><th scope="col">User</th><th scope="col">Activity</th><th scope="col">Date</th><th scope="col">Status</th><th scope="col" class="text-end">Action</th></tr></thead><tbody>@foreach ($activities as $activity)<tr><td><span class="activity-user"><span class="avatar avatar-table">{{ Str::upper(Str::substr($activity['user'], 0, 1)) }}</span>{{ $activity['user'] }}</span></td><td>{{ $activity['activity'] }}</td><td>{{ $activity['date'] }}</td><td><span class="status-badge status-{{ Str::lower($activity['status']) }}">{{ $activity['status'] }}</span></td><td class="text-end"><a href="#" class="view-action">View <i class="bi bi-arrow-up-right" aria-hidden="true"></i></a></td></tr>@endforeach</tbody></table></div></section>
</div>
@endsection

@section('scripts')
<script>
    const chartData = @json($chartData);
    new Chart(document.getElementById('transactionChart'), { type: 'line', data: { labels: chartData.labels, datasets: [{ data: chartData.values, borderColor: '#c9574b', backgroundColor: 'rgba(201, 87, 75, 0.12)', fill: true, tension: 0.4, pointRadius: 4, pointBackgroundColor: '#fff', pointBorderColor: '#c9574b', pointBorderWidth: 2 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: '#eee8df' }, ticks: { color: '#827b72' } }, x: { grid: { display: false }, ticks: { color: '#827b72' } } } } });
</script>
@endsection