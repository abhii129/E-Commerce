<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Existing methods ...
    public function index(Request $request)
{
    $query = User::where('role', 'customer');  // Only customers

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $users = $query->paginate(20);

    return view('admin.users.index', compact('users'));
}

    // Add this method:
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'number' => 'required|string|max:20',
            'age' => 'required|integer|min:1|max:150',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'role' => 'required|in:customer,admin',
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
