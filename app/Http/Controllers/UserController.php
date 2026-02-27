<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return back()->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 200,
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::find($user_id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'role' => 'required|in:admin,user'
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'User updated successfully');
    }

    public function destroy(Request $request)
    {
        $user_id = $request->input('user_id');

        // Prevent deleting yourself
        if (auth()->id() == $user_id) {
            return back()->with('error', 'You cannot delete your own account');
        }

        $user = User::find($user_id);
        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }

    public function delete($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 200,
            'user' => $user
        ]);
    }
}
