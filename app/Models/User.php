<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use LevelUp\Experience\Concerns\GiveExperience;
use LevelUp\Experience\Facades\Level;
use LevelUp\Experience\Concerns\HasAchievements;
use LevelUp\Experience\Concerns\HasStreaks;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, GiveExperience, HasAchievements, HasStreaks, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'school_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * User role checking methods
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Experience Points System
     */
    public function addPoints(int $amount): void
    {
        $this->addPoints($amount);
    }

    public function deductPoints(int $amount): void
    {
        $this->deductPoints($amount);
    }

    public function setPoints(int $amount): void
    {
        $this->setPoints($amount);
    }

    public function getPoints(): int
    {
        return $this->getPoints();
    }


}
