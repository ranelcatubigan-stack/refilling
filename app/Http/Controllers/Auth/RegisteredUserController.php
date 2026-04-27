<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show register form
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'first_name123' => ['required'],
        'middle_name123' => ['nullable'],
        'last_name123' => ['required'],
        'contact_number123' => ['required'],
        'philhealth123' => ['required'],
        'sss123' => ['required'],
        'pagibig123' => ['required'],
        'email123' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'confirmed'],
    ]);

    $user = User::create([
        'first_name'     => $request->first_name123,
        'middle_name'    => $request->middle_name123,
        'last_name'      => $request->last_name123,
        'email'          => $request->email123,
        'contact_number' => $request->contact_number123,
        'philhealth'     => $request->philhealth123,
        'sss'            => $request->sss123,
        'pagibig'        => $request->pagibig123,
        // ❌ removed role
        'password'       => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('dashboard');
}   
}