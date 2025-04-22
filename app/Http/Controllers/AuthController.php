<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
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

        $student = Student::where('id_number', $validated['username'])->first();
        // Check if the student exists
        // dd($student);
        // Check if the student exists and the password matches the last name
        if ($student) {
        // dd($validated['password'], $student->last_name); // Debugging line
            if (strtolower(trim($student->last_name)) === strtolower(trim($validated['password']))) {
                Auth::guard('student')->login($student);

                // Flash success message to the session
                return redirect()->route('student.dashboard')->with('success', 'Login successful! Welcome, ' . $student->first_name . '!');
            } else {
                return back()->withErrors(['login' => 'Password does not match our records.']);
            }
        } else {
            return back()->withErrors(['login' => 'Student ID not found.']);
        }

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
                // Try logging in as Student


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
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
        }
        // Redirect to the login page after logout
        return redirect()->route('login')->with('success', 'Logged out successfully');


    }


}
