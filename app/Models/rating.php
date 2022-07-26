<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'skill_id',
        'nb_stars'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    

}
