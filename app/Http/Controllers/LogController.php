<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Logs;
use Inertia\Inertia;


class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        $userId = $user->id;
        $logs = [];

        if ($role === 'Staff') {
            $logs = Logs::where('staff_id', $userId)->with('staff')->with('venue')->get();
        } elseif ($role === 'Manager') {
            $logs = Logs::where('manager_id', $userId)->with('manager')->with('venue')->get();
        }

       return Inertia::render('Log/Log', [
            'logs' => $logs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $logs = new Logs();
        $logs->fill($request->all());
        $logs->veneus_id = $userId;
        if ($role === 'Staff') {
            $logs->staff_id = $userId;
        } elseif ($role === 'Manager') {
            $logs->manager_id = $userId;
        }
        $logs->save();
        Logs::create([
            'name' => $request->name,
            'description' => $request->description,
            'perfomed_by' => $request->perfomed_by,
            'type' => $request->type,
            'manager_id' => $request->description,
            'staff_id' => $request->description,
            'veneus_id' => $event->user->id,
        ]);
    }
}