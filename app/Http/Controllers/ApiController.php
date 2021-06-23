<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Arr;

class ApiController extends Controller
{
    /**
     * Return specific user information as a json.
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInformation(): \Illuminate\Http\JsonResponse
    {

        $user = Arr::only(
            request()->user()->toArray(),
            ['name', 'email', 'avatar']
        );

        $user += [
            'role' => request()->user()->roleName()
        ];

        return response()->json($user);
    }

    /**
     * Return the last uploaded courses with owner, category and level relationship.
     * @return Illuminate\Http\JsonResponse
     */
    public function lastCourses(): \Illuminate\Http\JsonResponse
    {
        $courses = Course::latest()->take(3)
            ->with([
                'owner:id,name,email,avatar',
                'category:id,name',
                'level:id,name,scale'
            ])
            ->get();

        return response()->json(
            $courses->toArray()
        );
    }
}
