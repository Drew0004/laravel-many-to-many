<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    // Many to many Relationship
    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
