<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        $userId = $user->id;
        $venueCounts;
        $venues = [];
        $staffCounts = [];
        $year = Carbon::now()->year;

        if ($role === 'Staff') {
            $venueCounts = Venue::select('type', \DB::raw('count(*) as count'))
                    ->where('staff_id', '=', $userId)
                    ->groupBy('type')
                    ->get();
            $venues = Venue::where('staff_id', $userId)->get();
        } elseif ($role === 'Manager') {
            $venueCounts = Venue::select('type', \DB::raw('count(*) as count'))
                    ->where('manager_id', '=', $userId)
                    ->groupBy('type')
                    ->get();
            $venues = Venue::where('manager_id', $userId)->get();
            $staffCounts = User::select(\DB::raw("status, YEAR(created_at) as year, COUNT(*) as count"))
                ->groupBy('status', 'year')
                ->get()
                ->toArray();
        }

        return Inertia::render('Dashboard', [
            'venues' => $venues,
            'venueCounts' => $venueCounts,
            'staffCounts' => $staffCounts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}