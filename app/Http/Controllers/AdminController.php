<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
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
    // Show add payment form
    public function showAddPaymentForm()
    {
        // Get the logged-in admin
        $admin = Auth::guard('admin')->user(); // Use the admin guard here

        // Get the organization of the logged-in admin
        $organization = $admin->username;

        // Pass the organization to the view
        return view('admin.addpayment', compact('organization'));
    }

    public function showMembers(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $organization = $admin->username;

        $section = $request->input('section');

        $students = Student::where('organization', $organization)
            ->when($section, function ($query, $section) {
                $query->where('section', $section);
            })
            ->get();

        // Group sections by year
        $availableSections = Student::where('organization', $organization)
            ->pluck('section')
            ->unique()
            ->sort()
            ->values();

        $groupedSections = [];

        foreach ($availableSections as $sec) {
            $year = (int) substr($sec, 2, 1); // Cast to integer to avoid key issues
            $groupedSections[$year][] = $sec;
        }
        $allOrganizations = Admin::where('role', 'admin')
        ->where('username', '!=', $organization)
        ->pluck('username') // each username is an organization
        ->unique()
        ->sort()
        ->values();

        return view('admin.members', compact('students', 'organization', 'section', 'groupedSections', 'allOrganizations'));
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
