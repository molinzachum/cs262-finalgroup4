<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show all accounts
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    // Show one account
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Update account
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|integer',
            'description' => 'nullable|string',
            'dob' => 'nullable|date',
            'profile_picture' => 'nullable|string',
        ]);

        $user->update($request->all());

        return redirect()->back();
    }

    // Delete account
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}