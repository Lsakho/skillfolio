<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSkill extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'year', 'description'];
    protected $hidden = ['created_at', 'updated_at'];
}
