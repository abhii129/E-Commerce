<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'number' => 'required|string|max:20',
            'age' => 'required|integer|min:13|max:120',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'password' => 'required|string|confirmed|min:8',
            'terms' => 'accepted',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'age' => $request->age,
            'address' => $request->address,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            // user_id will be auto-generated!
        ]);

        Auth::login($user);

        return redirect()->route('customer.products.index');
    }
}
