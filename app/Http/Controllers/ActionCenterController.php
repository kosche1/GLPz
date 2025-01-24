<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LevelUp\Experience\Models\Level;
use LevelUp\Experience\Models\Achievement;

class ActionCenterController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $currentLevel = $user->level;
        $nextLevel = Level::where('level', '>', $currentLevel->level)
            ->orderBy('level')
            ->first();
        
        $achievements = Achievement::all();
        $userAchievements = $user->achievements;
        
        return view('action-center', compact('user', 'currentLevel', 'nextLevel', 'achievements', 'userAchievements'));
    }
} 