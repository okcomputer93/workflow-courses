<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;

class CoursesController extends Controller
{
    public function index()
    {
        return view('courses.index');
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

        auth()->user()->courses()
            ->create($this->validateRequest('store'));

        return redirect('/courses');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);

        $categories = Category::all();
        $levels = Level::all();

        return view('courses.edit', compact(
            'course',
            'categories',
            'levels'
        ));
    }

    public function update(Course $course)
    {
        $this->authorize('update', $course);

        $course->update($this->validateRequest('update'));

        return redirect($course->path());
    }

    public function validateRequest(String $type)
    {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'miniature' => $type === 'update'
                ? 'sometimes'
                : ''
                . '|required|image',
            'category_id' => 'required|exists:App\Models\Category,id',
            'level_id' => 'required|exists:App\Models\Level,id',
            'rate' => 'nullable|numeric|between:0,5',
            'video_url' => 'required|url',
        ]);

        if (request()->file('miniature')) {
            $path = request()->file('miniature')
                ->store('miniatures', 'public');

            $attributes['miniature'] = $path;
        }

        return $attributes;
    }
}
