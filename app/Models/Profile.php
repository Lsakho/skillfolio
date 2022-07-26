<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'description',
        'CC',
        'JC',
        'trainer',
        'challenge',
        'hobby',
        'status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    

    public function ProfileSkill()
    {
        return $this->belongsToMany(
            Skill::class, 
            ProfileSkill::class, 
            'profile_id', 
            'skill_id')
                    ->withTimestamps()
                    ->withPivot('level');
    }

    public function profileTraining()
    {
        return $this->belongsToMany(
            
            Training::class, 
            Session::class, 
            'profile_id', 
            'training_id')
                    ->withTimestamps()
                    ->withPivot('date');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'parentable');
    }


    public function entreprise()
    {
        return $this->belongsTo(Enterprise::class);
    }



    public function skills()
    {
        return $this->belongsToMany(
            Skill::class,
            rating::class,
            'profile_id',
            'skill_id'
            
        )->withPivot('nb_stars');
    }

    public function profiles_hobies()
    {
    return $this->belongsToMany(
        Hobbie::class, 
        ProfileHobbie::class,
        'profile_id', 
        'hobbie_id');

    }
}
