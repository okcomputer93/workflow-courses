<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }
    public function create()
    {
        $this->authorize('create', Course::class);

        return view('courses.create');

    }

    public function store()
    {
        $this->authorize('create', Course::class);

        auth()->user()->courses()
            ->create(request()->validate([
                'title' => 'required',
                'description' => 'required',
                'rate' => 'nullable|numeric|between:0,5',
                'video_url' => 'required|url'
            ])
        );

        return redirect('/courses');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }
}
