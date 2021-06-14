<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class WatchCoursesController extends Controller
{
    public function save(Request $request, Course $course)
    {
        $request->user()->saveAsView($course);
        return redirect(route('courses.watch', $course));
    }

    public function watch(Course $course)
    {
        $this->authorize('view', $course);
        return view('courses.watch', compact('course'));
    }
}
