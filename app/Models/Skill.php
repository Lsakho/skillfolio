<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProfileSkill;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'type' ];

    protected $hidden = ['created_at', 'updated_at'];

    public function jobskill()
    {
        return $this-> belongsToMany( 
            Job::class, 
            SkillJob::class, 
            'job_id', 
            'skill_id');
    }


    public function profiles()
    {
        return $this->belongsToMany(
            profile::class,
            rating::class,
            'skill_id',
            'profile_id'
            
        )->withPivot('nb_stars');
    }



    public function profileskill()
    {   

    return $this->belongsToMany(
        Profile::class, 
        ProfileSkill::class, 
        'profile_id', 
        'skill_id')
                 ->withTimestamps()
                 ->withPivot('level');
    }


}

