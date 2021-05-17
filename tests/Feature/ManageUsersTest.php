<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Professor;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUsersTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_be_register_as_a_professor()
    {
        $this->withoutExceptionHandling();
        $professor = UserFactory::withStorage('public')
            ->role('professor')->raw();

        $this->post('/register', $professor)
            ->assertRedirect('/');

        $this->assertDatabaseHas('professors', [
            'career' => $professor['career'],
            'about' => $professor['about'],
            'github_user' => $professor['github_user'],
            'twitter_user' => $professor['twitter_user']
        ]);

        Storage::disk('public')->assertExists(
            '/avatars/' . $professor['avatar']->hashName()
        );

        $user = User::latest()->first();
        $role = Professor::latest()->first();

        $this->assertEquals($user->role, $role);
    }

    /** @test */
    public function a_user_can_be_register_as_a_student()
    {
        $this->withoutExceptionHandling();

        $student = UserFactory::withStorage('public')
            ->role('student')->raw();

        $this->post('/register', $student)
            ->assertRedirect('/');

        $this->assertDatabaseHas('students', [
            'schooling' => $student['schooling'],
            'birthday' => $student['birthday'],
        ]);

        Storage::disk('public')->assertExists('/avatars/' . $student['avatar']->hashName());

        $user = User::latest()->first();
        $role = Student::latest()->first();

        $this->assertEquals($user->role, $role);
    }

}
