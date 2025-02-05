<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::where('teacher_id', auth()->id())
            ->latest()
            ->paginate(10);
            
        return view('teacher.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('teacher.activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'points' => 'required|integer|min:0',
            'difficulty' => 'required|in:easy,medium,hard',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $activity = Activity::create([
            ...$validated,
            'teacher_id' => auth()->id(),
        ]);

        return redirect()
            ->route('teacher.activities.index')
            ->with('success', 'Activity created successfully');
    }

    public function edit(Activity $activity)
    {
        $this->authorize('update', $activity);
        return view('teacher.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $this->authorize('update', $activity);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'points' => 'required|integer|min:0',
            'difficulty' => 'required|in:easy,medium,hard',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $activity->update($validated);

        return redirect()
            ->route('teacher.activities.index')
            ->with('success', 'Activity updated successfully');
    }

    public function destroy(Activity $activity)
    {
        $this->authorize('delete', $activity);
        
        $activity->delete();

        return redirect()
            ->route('teacher.activities.index')
            ->with('success', 'Activity deleted successfully');
    }
} 