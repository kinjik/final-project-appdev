<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\alert;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Show the login form
    }

    public function login(Request $request)
    {
        // Validate the incoming login credentials
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if the username exists
        $admin = Admin::where('username', $validated['username'])->first();

        if ($admin) {
            // dd($validated['password'], $admin->password); // C
            // Check the password using Hash::check
            if (Hash::check($validated['password'], $admin->password)) {
                // Log the user in by setting the admin in the session
                Auth::guard('admin')->loginUsingId($admin->id);

                // Check if the user is authenticated immediately after login attempt
                // dd(Auth::check(), Auth::user());
                // dd(session()->all());

                if (Auth::guard('admin')->check()) {
                    // This dumps `true` and the authenticated admin info
                    if ($admin->role == 'super_admin') {
                        return redirect()->route('superadmin.dashboard');
                    } else {
                        // alert("Welcome to the Admin Dashboard, {$admin->name}!");
                        return redirect()->route('admin.dashboard');

                    }
                } else {
                    dd('Login failed!');
                }

                // Redirect to the appropriate dashboard based on the admin's role

            } else {
                // dd('Invalid Username or Password!');
                // alert('Invalid Username or Password!');
                return back()->withErrors(['login' => 'Invalid Username or Password']);
                // return redirect()->route('login')->withErrors(['login' => 'Invalid credentials']);
            }
        } else {
            // dd('Admin not found!');
            return back()->withErrors(['login' => 'Invalid Username or Password']);

        }

        // If login fails, redirect back with an error message
        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();  // Logout using the 'admin' guard
        return redirect()->route('login');
    }


}
