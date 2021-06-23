<?php


namespace App\Pipelines;

use Closure;

interface Pipeline
{
    public function handle($input, Closure $next);
}
