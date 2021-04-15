<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function store()
    {
        Course::create(\request()->validate([
            'title' => 'required',
            'description' => 'required',
            'rate' => 'nullable|numeric|between:0,5'
        ]));

        return redirect('/courses');
    }
}
