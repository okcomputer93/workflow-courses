<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['schooling', 'birthday'];

    public function name()
    {
        return (new ReflectionClass($this))->getShortName();
    }

    public function user()
    {
        return $this->morphMany(User::class, 'role');
    }
}
