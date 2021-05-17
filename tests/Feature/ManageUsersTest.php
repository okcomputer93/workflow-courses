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

        $user = User::latest()->first();
        $role = Professor::latest()->first();

        $this->assertEquals($user->role, $role);
    }

    /** @test */
    public function a_user_can_be_register_as_a_student()
    {
        $student = UserFactory::withStorage('public')
            ->role('student')->raw();

        $this->post('/register', $student)
            ->assertRedirect('/');

        $this->assertDatabaseHas('students', [
            'schooling' => $student['schooling'],
            'birthday' => $student['birthday'],
        ]);
        
        $user = User::latest()->first();
        $role = Student::latest()->first();

        $this->assertEquals($user->role, $role);
    }

    /** @test */
    public function a_user_can_upload_its_avatar_as_profile_settings()
    {
        $student = UserFactory::withStorage('public')
            ->role('student')->raw();

        $this->post('/register', $student);

        Storage::disk('public')->assertExists('/avatars/' . $student['avatar']->hashName());
    }
}
