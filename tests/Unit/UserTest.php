<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_courses()
    {
        /*
         * There's no need to check that only Users with role professor can have courses
         * The Feature test is in charge of this.
         * */
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->courses);
    }

}
