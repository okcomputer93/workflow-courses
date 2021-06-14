<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Course;
use App\Policies\CommentsPolicy;
use App\Policies\CoursesPolicy;
use App\Policies\WatchCoursesPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Course::class => CoursesPolicy::class,
        Comment::class => CommentsPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
