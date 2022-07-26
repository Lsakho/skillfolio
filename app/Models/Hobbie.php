<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class Hobbie extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'description'
    ];
    protected $hidden = [
        'created_at', 
        'updated_at'
    ];
    public function profiles_hobies()
    {
        return $this->belongsToMany(
            
            Profile::class, 
            ProfileHobbie::class,
            'profile_id', 
            'hobbie_id');
    }
}
