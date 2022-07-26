<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'zip', 'city','contact_person'];
    protected $hidden = ['created_at', 'updated_at'];

    public function profiles()
    {
        return $this->belongsTo(Profile::class);
    }
}
