<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Mail\WelcomeEmail;
use Inertia\Inertia;

class StaffController extends Controller
{
    public function index()
    {
        $managerId = Auth::id();
        $staffMembers = User::where('role', User::ROLE_VENUE_STAFF)->where('manager_id', $managerId)->get();
        // Additional logic if needed

        return Inertia::render('Staff/Staff', [
            'staffMembers' => $staffMembers,
        ]);
    }

    public function create()
    {
        // Show create staff form
        return view('staff.create');
    }

    public function store(Request $request)
    {
        try {
            $managerId = Auth::id();

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            
            // Validate and store the new staff member
            $staffMember = new User();
            $staffMember->fill($request->all());
            $staffMember->role = User::ROLE_VENUE_STAFF;
            $staffMember->password = Hash::make($request->password);
            $staffMember->manager_id = $managerId;
            $staffMember->save();

            // Redirect to the index or show page
            $staffMembers = User::where('role', User::ROLE_VENUE_STAFF)->where('manager_id', $managerId)->get();
            // Additional logic if needed

            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status == Password::RESET_LINK_SENT) {
                return Inertia::render('Staff/Staff', [
                    'staffMembers' => $staffMembers,
                ]);
            }

            
            } catch (ValidationException $e) {
            // If form validation fails, return the validation errors
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // If an error occurs, return the error response to Inertia.js
            return Inertia::render('Staff/Create/CreateStaff', [
            'error' => $e->getMessage(),
            'input' => $request->all(),
        ]);
        }
    }

    public function edit($staffId)
    {
         // Show edit form for the specified venue
        $managerId = Auth::id();
        $staff = User::findOrFail($staffId);
        
        // Redirect to the index or show page
        return Inertia::render('Staff/Edit/EditStaff', [
            'staff' => $staff,
        ]);
    }
    
    public function update(Request $request)
    {
        $staff = User::findOrFail($request['id']);
        // Validate and update the staff
        $managerId = Auth::id();
        $staff->update($request->all());

        $staffMembers = User::where('role', User::ROLE_VENUE_STAFF)->where('manager_id', $managerId)->get();
        

        // Redirect to the index or show page
        return Inertia::render('Staff/Staff', [
            'staffMembers' => $staffMembers,
        ]);
    }

    public function destroy($staffId)
    {
        // Soft delete the venue
        $staff = User::find($staffId);

        if ($staff != null) {
            $staff->delete();
        }
        
        $managerId = Auth::id();
        $staffMembers = User::where('role', User::ROLE_VENUE_STAFF)->where('manager_id', $managerId)->get();

        // Redirect to the index or show page
        return Inertia::render('Staff/Staff', [
            'staffMembers' => $staffMembers,
        ]);
    }
}