<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Pipelines\Course\CourseMiniature;
use App\Pipelines\Course\CourseSlug;
use App\Rules\Course\BaseCourseRules;
use App\Rules\Course\CourseRulesCreate;
use App\Rules\Course\CourseRulesUpdate;
use App\Validation\CourseValidation;
use App\Validation\Validation;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class CoursesController extends Controller
{
    protected Validation $courseValidationUpdate;
    protected Validation $courseValidationCreate;

    /**
     * CoursesController constructor.
     */
    public function __construct()
    {
        $courseRulesCreate = new CourseRulesCreate(new BaseCourseRules());
        $courseRulesUpdate = new CourseRulesUpdate(new BaseCourseRules());


        $this->courseValidationUpdate = new CourseValidation($courseRulesUpdate);
        $this->courseValidationCreate = new CourseValidation($courseRulesCreate);

    }

    /**
     * Return index of all courses.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $totalCourses = Course::all()->count();
        return view('courses.index', compact('totalCourses'));
    }

    /**
     * Return a view for create a new course.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Course::class);
        $categories = Category::all();
        $levels = Level::all();
        return view('courses.create', compact('categories', 'levels'));
    }

    /**
     * Store in data base the received request for a course.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Course::class);

        $input = $request->all();

        $this->courseValidationCreate->validate($input);

        auth()->user()->courses()
            ->create(
               $this->coursePipeLine($input, $this->courseValidationCreate)
            );

        return redirect('/courses');
    }

    /**
     * Return a view to show a single course.
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Return a view with categories and levels to edit an existing course.
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
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

    /**
     * Preserves the request to update a course.
     * @param Course $course
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Course $course, Request $request)
    {
        $this->authorize('update', $course);

        $input = $request->all();

        $this->courseValidationUpdate
            ->validate($input);

        $course->update(
            $this->coursePipeLine($input, $this->courseValidationUpdate)
        );

        return redirect($course->refresh()->path());
    }

    /**
     * Send the input through a pipeline in order to modify the required keys and values.
     * @param array $input
     * @param CourseValidation $validation
     * @return mixed
     */
    private function coursePipeLine(array $input, CourseValidation $validation)
    {
        $pipe = app(Pipeline::class)
            ->send($validation->courseAttributes($input))
            ->through([
                CourseMiniature::class,
                CourseSlug::class
            ]);
        return $pipe->thenReturn();
    }
}
