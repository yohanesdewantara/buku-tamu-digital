<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $todayVisitors = Guest::getTodayVisitors();
        $myTodayGuests = Guest::where('created_by', auth()->id())
            ->whereDate('visit_date', Carbon::today())
            ->count();

        $recentGuests = Guest::with(['category'])
            ->where('created_by', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('user.dashboard', compact(
            'todayVisitors',
            'myTodayGuests',
            'recentGuests'
        ));
    }
}
