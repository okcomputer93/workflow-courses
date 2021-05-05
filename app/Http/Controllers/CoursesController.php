<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;

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
        $categories = Category::all();
        $levels = Level::all();
        return view('courses.create', compact('categories', 'levels'));
    }

    public function store()
    {
        $this->authorize('create', Course::class);

        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'miniature' => 'required|image',
            'category_id' => 'required',
            'level_id' => 'required',
            'rate' => 'nullable|numeric|between:0,5',
            'video_url' => 'required|url'
        ]);

        $path = request()->file('miniature')->store('miniatures', 'public');

        $attributes['miniature'] = $path;

        auth()->user()->courses()
            ->create($attributes);

        return redirect('/courses');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }
}
