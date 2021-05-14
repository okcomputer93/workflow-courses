<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['career', 'about', 'github_user', 'twitter_user'];

    public function user()
    {
        return $this->morphOne(User::class, 'role');
    }
}
