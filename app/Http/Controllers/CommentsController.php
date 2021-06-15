<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Course $course)
    {
        return response()->json($course->comments->load(
            ['author:id,name,email,avatar']
        ));
    }

    public function store(Request $request, Course $course)
    {
        $user = $request->user();

        $this->authorize('create', [Comment::class, $course]);

        $attributes = $request->validate([
           'content' => 'required',
           'rate' => 'required|numeric|between:1,5'
        ]);

        $user->addComment($attributes, $course);
    }
}
