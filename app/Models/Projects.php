<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $table = 'projects';

    public function jobs() {
        return $this->hasMany(ProjectJobs::class);
    }    

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'project_users', 'project_id', 'user_id');
    }

    public function asignedUsers() {
        return $this->hasMany(User::class);
    }
}
