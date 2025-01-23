<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LevelUp\Experience\Models\Level;

class LevelManagementController extends Controller
{
    public function index()
    {
        $levels = Level::orderBy('level')->get();
        return view('superadmin.level-management', compact('levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|integer|min:1|unique:levels,level',
            'next_level_experience' => 'required|integer|min:0',
        ]);

        Level::create([
            'level' => $request->level,
            'next_level_experience' => $request->next_level_experience,
        ]);

        return redirect()->back()->with('success', 'Level created successfully');
    }

    public function update(Request $request, Level $level)
    {
        $request->validate([
            'level' => 'required|integer|min:1|unique:levels,level,' . $level->id,
            'next_level_experience' => 'required|integer|min:0',
        ]);

        $level->update([
            'level' => $request->level,
            'next_level_experience' => $request->next_level_experience,
        ]);

        return redirect()->back()->with('success', 'Level updated successfully');
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->back()->with('success', 'Level deleted successfully');
    }
} 