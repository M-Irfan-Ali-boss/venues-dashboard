<?php

namespace App\Http\Controllers;use Illuminate\Support\Str;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Venue;
use App\Models\Logs;
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
        $managerId = null;
        $staffId = null;

        if ($role === 'Staff') {
            $venues = Venue::where('staff_id', $userId)->get();
            $staffId = $userId;
        } elseif ($role === 'Manager') {
            $venues = Venue::where('manager_id', $userId)->get();
            $managerId = $userId;
        }

        $logs = Logs::create([
            'name' => $request->name,
            'description' => $request->description,
            'perfomed_by' => $user->role,
            'type' => 'event_create',
            'manager_id' => $managerId,
            'staff_id' => $staffId,
            'veneus_id' => $venue->id,
        ]);

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
        $venue->update($request->all());
        $user = Auth::user();
        $role = $user->role;
        $userId = $user->id;
        $venues = [];
        $staffId = null;
        $managerId = null;

        if ($role === 'Staff') {
            $venues = Venue::where('staff_id', $userId)->get();
            $staffId = $userId;
        } elseif ($role === 'Manager') {
            $venues = Venue::where('manager_id', $userId)->get();
            $managerId = $userId;
        }

        $logs = Logs::create([
            'name' => $request->name,
            'description' => $request->description,
            'perfomed_by' => $user->role,
            'type' => 'event_updated',
            'manager_id' => $managerId,
            'staff_id' => $staffId,
            'veneus_id' => $venue->id,
        ]);

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
        
        $user = Auth::user();
        $role = $user->role;
        $userId = $user->id;
        $venues = Venue::where('manager_id', $userId)->get();
        $staffId = null;
        $managerId = null;

        if ($role === 'Staff') {
            $staffId = $userId;
        } elseif ($role === 'Manager') {
            $managerId = $userId;
        }
        

        $logs = Logs::create([
            'name' => 'Delete Event',
            'description' => 'Delete Event Description',
            'perfomed_by' => $user->role,
            'type' => 'event_deleted',
            'manager_id' => $managerId,
            'staff_id' => $staffId,
            'veneus_id' => $venue->id,
        ]);

        // Redirect to the index or show page
        return Inertia::render('Venue/Venue', [
            'venues' => $venues,
        ]);
    }
}