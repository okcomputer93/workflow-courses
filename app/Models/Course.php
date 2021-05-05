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
        'level_id'
    ];

    public function path()
    {
        return route('courses.show', $this);
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
}
