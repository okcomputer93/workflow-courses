<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CoursesController extends Controller
{
    public function store()
    {
        $this->authorize('create', Course::class);

        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'rate' => 'nullable|numeric|between:0,5'
        ]);

        $attributes['professor_id'] = auth()->id();

        Course::create($attributes);

        return redirect('/courses');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }
}
