<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @param Course $course
     * @return mixed
     */
    public function create(User $user, Course $course)
    {
        return $user->views->contains($course);
    }

}
