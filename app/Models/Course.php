<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected int $maxRate = 5;

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
        return $this->hasMany(Comment::class)
            ->latest('created_at');
    }

    public function viewers()
    {
        return $this->belongsToMany(User::class);
    }


    public function addComment(array $attributes, User $user)
    {
        $comment = new Comment();

        foreach ($attributes as $key => $value) {
            $comment->$key = $value;
        }

        $comment->course()->associate($this);

        $comment->author()->associate($user);

        $comment->save();

        $this->refreshRate();

        return Comment::with(['author:id,name,email,avatar'])
            ->find($comment->id);
    }

    public function isCommentedBy(User $user)
    {
        return $this->comments()
            ->where('user_id', $user->id)
            ->exists();

    }

    public function refreshRate() {
        $this->rate = $this->comments()->pluck('rate')->avg();
        $this->save();
    }

    public function ratePercentage()
    {
        return $this->rate * 100 / $this->maxRate;
    }
}
