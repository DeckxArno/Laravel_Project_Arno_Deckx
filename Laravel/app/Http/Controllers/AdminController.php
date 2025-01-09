<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // Haal alle gebruikers op
        return view('admin.dashboard', compact('users'));
    }

    public function makeAdmin(User $user)
    {
        $user->update(['is_admin' => true]);
        return redirect()->back()->with('success', 'Gebruiker is nu een admin.');
    }

    public function removeAdmin(User $user)
    {
        $user->update(['is_admin' => false]);
        return redirect()->back()->with('success', 'Adminrechten verwijderd.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin ?? false
        ]);

        return redirect()->back()->with('success', 'Nieuwe gebruiker aangemaakt.');
    }
}

