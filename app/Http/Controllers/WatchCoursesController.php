<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class WatchCoursesController extends Controller
{
    /**
     * Save the course as a view for a specific user.
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request, Course $course)
    {
        $request->user()->saveAsView($course);
        return redirect(route('courses.watch', $course));
    }

    /**
     * Based on authorization return a view to watch a course video.
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function watch(Course $course)
    {
        $this->authorize('view', $course);
        return view('courses.watch', compact('course'));
    }
}
