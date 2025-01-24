<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use LevelUp\Experience\Facades\Level;
use Spatie\Permission\Models\Role;

class AccountManagementController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('superadmin.account-management', compact('users'));
    }

    public function update(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'nullable|string|max:255',
            'email' => [
                'nullable', 
                'email', 
                Rule::unique('users', 'email')->ignore($request->input('user_id'))
            ],
            'role' => 'required|string|in:student,teacher,admin,superadmin'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false, 
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            // Find the user
            $user = User::findOrFail($request->input('user_id'));

            // Update user details
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            
            // Update role using Spatie's Permission package
            $newRole = $request->input('role');
            
            // Remove all current roles
            $user->syncRoles([]);
            
            // Assign the new role
            $user->assignRole($newRole);
            
            $user->save();

            // Return success response
            return response()->json([
                'success' => true, 
                'message' => 'User updated successfully',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            // Handle any unexpected errors
            return response()->json([
                'success' => false, 
                'message' => 'An error occurred while updating the user: ' . $e->getMessage()
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

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            // Create the user
            $role = $request->input('role');
            $password = bcrypt($role . '123');
            $user = User::create([
                'school_id' => $request->input('school_id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $role,
                'password' => $password
            ]);

            // Initialize user with level 1
            Level::setUserLevel($user, 1);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Account created successfully',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            // Handle any unexpected errors
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
