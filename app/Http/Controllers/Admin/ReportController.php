<?php


// app/Http/Controllers/Admin/ReportController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\GuestCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuestsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Guest::with(['category', 'creator']);

        // Filters
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $query->filterByDate($request->start_date, $request->end_date);
        }

        if ($request->filled('category')) {
            $query->filterByCategory($request->category);
        }

        $guests = $query->orderBy('visit_date', 'desc')->get();
        $categories = GuestCategory::all();

        // Statistics
        $totalGuests = $guests->count();
        $todayGuests = $guests->where('visit_date', Carbon::today())->count();
        $weeklyGuests = $guests->whereBetween('visit_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        $monthlyGuests = $guests->where('visit_date', '>=', Carbon::now()->startOfMonth())->count();

        return view('admin.reports.index', compact(
            'guests',
            'categories',
            'totalGuests',
            'todayGuests',
            'weeklyGuests',
            'monthlyGuests'
        ));
    }

    public function exportExcel(Request $request)
    {
        $filename = 'laporan-buku-tamu-' . Carbon::now()->format('Y-m-d-H-i-s') . '.xlsx';

        return Excel::download(new GuestsExport($request->all()), $filename);
    }

    public function exportPdf(Request $request)
    {
        $query = Guest::with(['category', 'creator']);

        // Apply same filters as index
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $query->filterByDate($request->start_date, $request->end_date);
        }

        if ($request->filled('category')) {
            $query->filterByCategory($request->category);
        }

        $guests = $query->orderBy('visit_date', 'desc')->get();

        $pdf = Pdf::loadView('admin.reports.pdf', compact('guests'))
            ->setPaper('a4', 'landscape');

        $filename = 'laporan-buku-tamu-' . Carbon::now()->format('Y-m-d-H-i-s') . '.pdf';

        return $pdf->download($filename);
    }
}
