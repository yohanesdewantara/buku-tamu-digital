<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\User;
use App\Models\GuestCategory;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $todayVisitors = Guest::getTodayVisitors();
        $weeklyVisitors = Guest::getWeeklyVisitors();
        $monthlyVisitors = Guest::getMonthlyVisitors();
        $totalVisitors = Guest::count();

        $topInstitutions = Guest::getVisitorsByInstitution(5);
        $dailyChart = Guest::getDailyVisitorsChart(30);

        $recentGuests = Guest::with(['category', 'creator'])
            ->orderByDesc('visit_date')   // utama
            ->orderByDesc('created_at')   // cadangan kalau ada yang null
            ->orderByDesc('id')           // jaga-jaga
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'todayVisitors',
            'weeklyVisitors',
            'monthlyVisitors',
            'totalVisitors',
            'topInstitutions',
            'dailyChart',
            'recentGuests'
        ));
    }
}
