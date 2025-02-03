<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use LevelUp\Experience\Models\Level;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AccountManagementController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('superadmin.account-management', compact('users'));
    }

    public function update(Request $request)
    {
        try {
            // Add superadmin to allowed roles if user is superadmin
            $allowedRoles = ['student', 'teacher', 'admin'];
            if (auth()->user()->isSuperAdmin()) {
                $allowedRoles[] = 'superadmin';
            }

            $request->validate([
                'user_id' => 'required|exists:users,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $request->user_id,
                'role' => 'required|in:' . implode(',', $allowedRoles)
            ]);

            $user = User::findOrFail($request->user_id);
            
            DB::beginTransaction();
            
            // First, ensure the role exists in Spatie
            $role = Role::firstOrCreate(['name' => $request->role, 'guard_name' => 'web']);
            
            // Update basic user information
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ]);

            // Remove old roles and assign new role using Spatie
            $user->syncRoles([$role]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'school_id' => 'nullable|integer|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required|string|in:student,teacher,admin,superadmin'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Create the user
            $role = $request->input('role');
            
            // Ensure the role exists in Spatie
            $spatie_role = Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
            
            $user = User::create([
                'school_id' => $request->input('school_id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $role,
                'password' => Hash::make($role . '123') // Default password based on role
            ]);

            // Assign role using Spatie
            $user->assignRole($spatie_role);

            // Initialize user with level 1 if the Level facade exists
            if (class_exists('LevelUp\Experience\Facades\Level')) {
                Level::setUserLevel($user, 1);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Account created successfully',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the account: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id'
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false, 
                    'message' => $validator->errors()->first()
                ], 400);
            }

            // Find and delete the user
            $user = User::findOrFail($request->input('user_id'));
            $user->delete();

            // Return success response
            return response()->json([
                'success' => true, 
                'message' => 'User deleted successfully'
            ]);
        } catch (\Exception $e) {
            // Handle any unexpected errors
            return response()->json([
                'success' => false, 
                'message' => 'An error occurred while deleting the user: ' . $e->getMessage()
            ], 500);
        }
    }
}
