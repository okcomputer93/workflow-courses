<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function store()
    {
        Course::create(\request(['title', 'description', 'rate']));

        return redirect('/courses');
    }
}
