<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class ApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function userInformation(): JsonResponse
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

    public function lastCourses(): JsonResponse
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
