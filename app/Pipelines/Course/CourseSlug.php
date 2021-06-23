<?php


namespace App\Pipelines\Course;


use Closure;
use Illuminate\Support\Str;

class CourseSlug implements \App\Pipelines\Pipeline
{

    public function handle($input, Closure $next)
    {
        $slug = [
            'slug' => Str::slug($input['title'])
        ];

        $input = array_replace($input, $slug);

        return $next($input);
    }
}
