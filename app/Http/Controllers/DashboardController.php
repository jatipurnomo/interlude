<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        return view('dashboard.index', [
            'user' => $user,
            'userInitials' => $user->initials(),
            'userRole' => data_get($user, 'role', 'Administrator'),
            'statistics' => [
                ['label' => 'Total Users', 'value' => '1,250', 'change' => '+12%', 'trend' => 'up'],
                ['label' => 'Total Transactions', 'value' => '8,542', 'change' => '+8%', 'trend' => 'up'],
                ['label' => 'Total Reports', 'value' => '325', 'change' => '+5%', 'trend' => 'up'],
                ['label' => 'Pending Tasks', 'value' => '24', 'change' => '-3%', 'trend' => 'down'],
            ],
            'chartData' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June'],
                'values' => [820, 1040, 960, 1320, 1180, 1540],
            ],
            'activities' => [
                ['user' => 'John', 'activity' => 'Create Report', 'date' => '04 Sep 2026', 'status' => 'Success'],
                ['user' => 'Jane', 'activity' => 'Update Profile', 'date' => '04 Sep 2026', 'status' => 'Success'],
                ['user' => 'Michael', 'activity' => 'Generate Report', 'date' => '03 Sep 2026', 'status' => 'Pending'],
            ],
        ]);
    }
}
