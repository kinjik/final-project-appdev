<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use function Laravel\Prompts\alert;

class AdminController extends Controller
{
    // Admin dashboard
    public function dashboard()
    {
        // Get the logged-in admin
        $admin = Auth::guard('admin')->user(); // Use the admin guard here

        // Get the organization of the logged-in admin
        $organization = $admin->username;
        // dd($organization); // Debugging line
        // Pass the organization to the view
        // dd($organization); // Debugging line
        return view('admin.dashboard', compact('organization'));
    }

    // Super Admin dashboard
    public function superAdminDashboard()
    {
            // Fetch all admins (excluding the super admin)
        $admins = Admin::where('role', 'admin')->get();

        // Pass the admins data to the view
        return view('superadmin.dashboard', compact('admins'));
    }


    // User management for super admin
    public function userManagementSuperAdmin()
    {
        // Fetch all admins (excluding the super admin)
        $admins = Admin::where('role', 'admin')->get();

        // Pass the admins data to the view
        return view('superadmin.usermanagement', compact('admins'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Only update name (always)
        $admin->name = $request->name;

        // Check if password has changed
        if ($request->filled('password') && $request->password !== $admin->plain_password) {
            $admin->plain_password = $request->password; // store plain
            $admin->password = Hash::make($request->password); // store hashed
        }

        $admin->save();

        return redirect()->back()->with('success', 'Treasurer updated successfully!');
    }
}
