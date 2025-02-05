<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Subject;

class ActivityManager extends Component
{
    public $activity;
    public $title;
    public $description;
    public $subject_id;
    public $difficulty;
    public $exp_points;
    public $subjects;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'subject_id' => 'required|exists:subjects,id',
        'difficulty' => 'required|in:easy,medium,hard',
        'exp_points' => 'required|integer|min:0'
    ];

    public function mount()
    {
        // Get subjects based on user role
        $this->subjects = Subject::when(auth()->user()->isTeacher(), function($query) {
            return $query->where('teacher_id', auth()->id());
        })->get();
    }

    public function save()
    {
        $this->validate();
        
        $teacherId = auth()->user()->isTeacher() ? auth()->id() : $this->teacher_id;
        
        Activity::create([
            'title' => $this->title,
            'description' => $this->description,
            'subject_id' => $this->subject_id,
            'difficulty' => $this->difficulty,
            'exp_points' => $this->exp_points,
            'teacher_id' => $teacherId
        ]);

        $this->reset();
        $this->emit('activityCreated');
    }

    public function render()
    {
        return view('livewire.activity-manager');
    }
} 