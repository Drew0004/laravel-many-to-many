<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
    ];

    // Many to many Relationship
    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
