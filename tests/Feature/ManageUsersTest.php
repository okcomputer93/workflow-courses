<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Professor;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUsersTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_student_can_be_registered_without_role_info()
    {
        $user = User::factory()->raw([
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        unset($user['avatar']);

        $this->post('/register', $user)
            ->assertRedirect('/');

        $columns = ['name', 'email'];

        $lastUser = User::latest()->first();

        foreach ($columns as $column) {
            $this->assertEquals($lastUser->$column, $user[$column]);
        }
        $this->assertTrue(Hash::check($user['password'], $lastUser->password));
    }

    /** @test */
    public function a_user_can_be_register_as_a_professor()
    {
        $professor = UserFactory::withStorage('public')
            ->role('professor');

        $this->post('/register', $professor->raw())
            ->assertRedirect('/');

        $this->assertDatabaseHas('professors', $professor->roleAttributeS());

        $user = User::latest()->first();
        $role = Professor::latest()->first();

        $this->assertEquals($user->role, $role);
    }

    /** @test */
    public function a_user_can_be_register_as_a_student()
    {
        $student = UserFactory::withStorage('public')
            ->role('student');

        $this->post('/register', $student->raw())
            ->assertRedirect('/');

        $this->assertDatabaseHas('students', $student->roleAttributes());

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
