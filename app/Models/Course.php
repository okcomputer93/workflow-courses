<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'rate',
        'professor_id',
        'video_url',
        'miniature',
        'category_id',
        'level_id',
        'slug'
    ];

    public function path($route = 'show')
    {
        return route("courses.$route", $this);
    }

    public function watchPath()
    {
        return route('courses.watch', $this);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function viewers()
    {
        return $this->belongsToMany(User::class);
    }
}
