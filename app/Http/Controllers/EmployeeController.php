<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Employee page (dropdown + selected result)
     */
    public function index(Request $request)
{
    $users = User::all();

    $selectedUser = null;

    if ($request->filled('user_id')) {
        $selectedUser = User::find($request->user_id);
    }

    return view('employees.index', compact('users', 'selectedUser'));
}
}