<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Return all comments from a course including author information.
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Course $course): \Illuminate\Http\JsonResponse
    {
        return response()->json($course->comments->load(
            ['author:id,name,email,avatar']
        ));
    }

    /**
     * Based on request a comment is stored in a course.
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Course $course): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();

        $this->authorize('create', [Comment::class, $course]);

        $attributes = $request->validate([
           'content' => 'required',
           'rate' => 'required|numeric|between:1,5'
        ]);

        $comment = $course->addComment($attributes, $user);

        return response()->json($comment);
    }
}
