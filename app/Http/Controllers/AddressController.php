<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses()->orderByDesc('is_default')->get();
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'nullable|string|max:50',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        $user = Auth::user();

        $address = $user->addresses()->create($request->all());

        if ($request->has('set_default')) {
            // Clear other defaults
            $user->addresses()->update(['is_default' => false]);
            $address->is_default = true;
            $address->save();
        }

        return redirect()->route('addresses.index')->with('success', 'Address added.');
    }

    public function setDefault(Address $address)
    {
        $user = Auth::user();
        if ($address->user_id !== $user->id) {
            abort(403);
        }
        $user->addresses()->update(['is_default' => false]);
        $address->is_default = true;
        $address->save();
        return back()->with('success', 'Default address updated.');
    }

    public function destroy(Address $address)
    {
        $user = Auth::user();
        if ($address->user_id !== $user->id) {
            abort(403);
        }
        $address->delete();
        return back()->with('success', 'Address deleted.');
    }

    public function adminIndex(Request $request)
    {
        // Authorization: Only admins allowed
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $query = Address::with('user');

        // Optional search by user name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $addresses = $query->paginate(20);

        return view('addresses.adminindex', compact('addresses'));
    }
}
