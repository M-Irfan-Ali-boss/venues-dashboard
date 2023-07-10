<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VenueController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        $userId = $user->id;
        $venues = [];

        if ($role === 'Staff') {
            $venues = Venue::where('staff_id', $userId)->get();
        } elseif ($role === 'Manager') {
            $venues = Venue::where('manager_id', $userId)->get();
        }
        // Additional logic if needed

       return Inertia::render('Venue/Venue', [
            'venues' => $venues,
        ]);
    }
    
    public function createVenue()
    {
        $managerId = Auth::id();
        $user = Auth::user();
        $role = $user->role;
        $staffMembers = User::where('role', User::ROLE_VENUE_STAFF)->where('manager_id', $managerId)->get();
        // Additional logic if needed

       return Inertia::render('Venue/Create/CreateVenue', [
            'staffs' => $staffMembers,
        ]);
    }

    public function create()
    {
        // Show create venue form
        return view('venues.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new venue
        $managerId = Auth::id();
        $venue = new Venue();
        $venue->fill($request->all());
        $venue->manager_id = $managerId;
        $venue->save();

        $user = Auth::user();
        $role = $user->role;
        $userId = $user->id;
        $venues = [];

        if ($role === 'Staff') {
            $venues = Venue::where('staff_id', $userId)->get();
        } elseif ($role === 'Manager') {
            $venues = Venue::where('manager_id', $userId)->get();
        }

        // Redirect to the index or show page
        return Inertia::render('Venue/Venue', [
            'venues' => $venues,
        ]);
    }

    public function edit($venueId)
    {
        // Show edit form for the specified venue
        $managerId = Auth::id();
        $venue = Venue::findOrFail($venueId);
        $staffs = User::where('role', User::ROLE_VENUE_STAFF)->where('manager_id', $managerId)->get();
        
        // Redirect to the index or show page
        return Inertia::render('Venue/Edit/EditVenue', [
            'venue' => $venue,
            'staffs' => $staffs,
        ]);
    }
    
    public function update(Request $request)
    {
        $venue = Venue::findOrFail($request['id']);
        // Validate and update the venue
        $managerId = Auth::id();
        $venue->update($request->all());
        $user = Auth::user();
        $role = $user->role;
        $userId = $user->id;
        $venues = [];

        if ($role === 'Staff') {
            $venues = Venue::where('staff_id', $userId)->get();
        } elseif ($role === 'Manager') {
            $venues = Venue::where('manager_id', $userId)->get();
        }

        // Redirect to the index or show page
        return Inertia::render('Venue/Venue', [
            'venues' => $venues,
        ]);
    }

    public function destroy($venueId)
    {
        // Soft delete the venue
        $venue = Venue::find($venueId);
        $venue->delete();
        
        $managerId = Auth::id();
        $venues = Venue::where('manager_id', $managerId)->get();

        // Redirect to the index or show page
        return Inertia::render('Venue/Venue', [
            'venues' => $venues,
        ]);
    }
}