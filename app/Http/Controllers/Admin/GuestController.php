<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\GuestCategory;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $query = Guest::with(['category', 'creator']);

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->filterByCategory($request->category);
        }

        // Filter by date
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $query->filterByDate($request->start_date, $request->end_date);
        }

        $guests = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = GuestCategory::all();

        return view('admin.guests.index', compact('guests', 'categories'));
    }

    public function create()
    {
        $categories = GuestCategory::all();
        return view('admin.guests.create', compact('categories'));
    }

    public function store(StoreGuestRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('guests/photos', 'public');
        }

        Guest::create($data);

        return redirect()->route('admin.guests.index')
            ->with('success', 'Data tamu berhasil ditambahkan.');
    }

    public function show(Guest $guest)
    {
        $guest->load(['category', 'creator']);
        return view('admin.guests.show', compact('guest'));
    }

    public function edit(Guest $guest)
    {
        $categories = GuestCategory::all();
        return view('admin.guests.edit', compact('guest', 'categories'));
    }

    public function update(UpdateGuestRequest $request, Guest $guest)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($guest->photo) {
                Storage::disk('public')->delete($guest->photo);
            }
            $data['photo'] = $request->file('photo')->store('guests/photos', 'public');
        }

        $guest->update($data);

        return redirect()->route('admin.guests.index')
            ->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function destroy(Guest $guest)
    {
        // Delete photo
        if ($guest->photo) {
            Storage::disk('public')->delete($guest->photo);
        }

        $guest->delete();

        return redirect()->route('admin.guests.index')
            ->with('success', 'Data tamu berhasil dihapus.');
    }
}
