<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type'];
    protected $hidden = ['created_at', 'updated_at'];

    public function profileTraining()
    {
        return $this->belongsToMany(

            Profile::class, 
            Session::class, 
            'profile_id', 
            'training_id')
                    ->withTimestamps()
                    ->withPivot('date');
    }
}

