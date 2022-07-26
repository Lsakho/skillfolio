<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    protected $hidden = ['created_at', 'updated_at'];

    public function jobskill()
    {
        return $this-> belongsToMany(
            Skill::class, 
            SkillJob::class, 
            'job_id', 
            'skill_id');
    }
}
