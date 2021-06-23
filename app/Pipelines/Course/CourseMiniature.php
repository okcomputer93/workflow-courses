<?php


namespace App\Pipelines\Course;


use Closure;

class CourseMiniature implements \App\Pipelines\Pipeline
{

    public function handle($input, Closure $next)
    {
        if (array_key_exists('miniature', $input)) {
            $path = [
                'miniature' => $input['miniature']->store('miniatures', 'public')
            ];
            $input = array_replace($input, $path);
        }
        return $next($input);
    }
}
