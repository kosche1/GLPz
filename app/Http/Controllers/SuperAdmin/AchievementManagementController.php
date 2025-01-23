<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LevelUp\Experience\Models\Achievement;

class AchievementManagementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('name')->get();
        return view('superadmin.achievement-management', compact('achievements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:achievements,name',
            'description' => 'required|string|max:1000',
            'is_secret' => 'boolean',
            'image' => 'nullable|string|max:255',
        ]);

        Achievement::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_secret' => $request->boolean('is_secret', false),
            'image' => $request->image,
        ]);

        return redirect()->back()->with('success', 'Achievement created successfully');
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:achievements,name,' . $achievement->id,
            'description' => 'required|string|max:1000',
            'is_secret' => 'boolean',
            'image' => 'nullable|string|max:255',
        ]);

        $achievement->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_secret' => $request->boolean('is_secret', false),
            'image' => $request->image,
        ]);

        return redirect()->back()->with('success', 'Achievement updated successfully');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return redirect()->back()->with('success', 'Achievement deleted successfully');
    }
} 