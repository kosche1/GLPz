<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get statistics for the teacher dashboard
            $studentCount = User::where('role', 'student')->count();
            $courseCount = Course::count();
            $pendingAssignments = 12; // Replace with actual logic
            $averageProgress = 78; // Replace with actual logic
            
            return view('teacher.dashboard', compact(
                'studentCount',
                'courseCount',
                'pendingAssignments',
                'averageProgress'
            ));
        } catch (\Exception $e) {
            return view('teacher.dashboard')->with('error', 'Error loading dashboard data');
        }
    }
} 