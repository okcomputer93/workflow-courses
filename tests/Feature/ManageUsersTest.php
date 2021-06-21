<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use App\Validation\BaseUserRules;
use App\Validation\ProfessorRules;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
            'role' => 'student'
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

        $this->assertDatabaseHas('professors', $professor->roleAttributes());

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

    /** @test */
    public function an_unregistered_user_does_not_have_a_profile()
    {
        $this->get(route('profile.show'))
            ->assertRedirect('login');
    }

    /** @test */
    public function a_registered_student_can_access_its_profile()
    {
        $this->signIn();

        $this->get(route('profile.show'))
            ->assertStatus(200);
    }

    /** @test */
    public function a_registered_professor_can_access_its_profile()
    {
        $this->signIn($role = 'professor');

        $this->get(route('profile.show'))
            ->assertStatus(200);
    }
//
//    /** @test */
//    public function a_registered_user_can_see_its_information_on_its_profile()
//    {
//        $user = $this->signIn();
//
//        $this->get(route('profile.show'))
//            ->assertSee($user->name)
//            ->assertSee($user->email)
//            ->assertSee($user->avatar);
//    }

    /** @test */
    public function a_registered_user_can_update_just_its_name()
    {
        $user = $this->signIn();

        $attributes = [
            'name' => 'Edited',
            'email' => $user->email,
            'avatar' => null
        ];

        $this->put(route('user-profile-information.update'), $attributes);

        unset($attributes['avatar']);

        $this->assertDatabaseHas('users', $attributes);
    }

    /** @test */
    public function a_registered_user_can_update_just_its_email()
    {
        $user = $this->signIn();

        $attributes = [
            'name' => $user->name,
            'email' => 'somerandomemail@example.com',
            'avatar' => null
        ];

        $this->put(route('user-profile-information.update'), $attributes);

        unset($attributes['avatar']);

        $this->assertDatabaseHas('users', $attributes);
    }


    /** @test */
    public function a_registered_student_can_update_its_profile_information()
    {
        $this->signIn();

        $userAttributes = [
            'name' => 'Jhon Doe Edited',
            'email' => 'jhonedited@example.com',
            'avatar' => null
        ];

        $roleAttributes = [
            'schooling' => 'Brand New Schooling'
        ];

        $attributes = array_merge($userAttributes, $roleAttributes);

        $this->put(route('user-profile-information.update'), $attributes);

        unset($userAttributes['avatar']);


        $this->assertDatabaseHas('users', $userAttributes);
        $this->assertDatabaseHas('students', $roleAttributes);
    }

    /** @test */
    public function a_registered_professor_can_update_its_profile_information()
    {
        $this->signIn('professor');

        $userAttributes = [
            'name' => 'Jhon Doe Edited',
            'email' => 'jhonedited@example.com',
            'avatar' => null,
        ];

        $roleAttributes = [
            'career' => 'Brand New Career',
            'about' => 'This is an edited about.',
            'twitter_user' => 'edited',
            'github_user' => 'edited'
        ];

        $attributes = array_merge($userAttributes, $roleAttributes);

        $this->put(route('user-profile-information.update'), $attributes);

        unset($userAttributes['avatar']);


        $this->assertDatabaseHas('users', $userAttributes);
        $this->assertDatabaseHas('professors', $roleAttributes);
    }

    /** @test */
    public function a_registered_user_can_update_its_avatar()
    {
        $user = UserFactory::withStorage('public')
            ->role('student');

        $this->signIn(null, $user->create());

        $attributes = $user->raw();

        $this->put(route('user-profile-information.update'), $attributes);

        Storage::disk('public')->assertExists(
            '/avatars/' . $attributes['avatar']->hashName()
        );
    }

    /** @test */
    public function a_registered_student_cannot_update_itself_to_professor()
    {
        $this->signIn();

        $userAttributes = [
            'name' => 'Jhon Doe Edited',
            'email' => 'jhonedited@example.com',
            'role' => 'professor'
        ];

        $roleAttributes = [
            'career' => 'Hacked',
            'about' => 'You just been hacked HAHA!',
            'twitter_user' => 'hacked',
            'github_user' => 'hacked'
        ];

        $attributes = array_merge($userAttributes, $roleAttributes);

        $this->put(route('user-profile-information.update'), $attributes);

        $this->assertDatabaseMissing('users', $userAttributes);
        $this->assertDatabaseMissing('professors', $roleAttributes);
    }

    /** @test */
    public function a_registered_student_can_request_to_become_a_professor()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();

        $newRoleAttributes = $attributes = [
            'career' => 'Programmer',
            'about' => 'Im a student but I wanna become a professor.',
            'twitter_user' => 'some_user',
            'github_user' => 'some_user'
        ];

        $newRoleAttributes['role'] = 'professor';

        $this->assertInstanceOf(Student::class, $user->role);

        $this->patch(route('user-role-information.update'), $newRoleAttributes);

        $this->assertDatabaseHas('professors', $attributes);

        $this->assertInstanceOf(Professor::class, $user->refresh()->role);

    }

    /** @test */
    public function a_registered_professor_cannot_request_to_become_a_student()
    {
        $user = $this->signIn('professor');

        $newRoleAttributes = $attributes = [
            'schooling' => 'Hacked.',
        ];

        $newRoleAttributes['role'] = 'student';

        $this->assertInstanceOf(Professor::class, $user->role);

        $this->patch(route('user-role-information.update'), $newRoleAttributes);

        $this->assertDatabaseMissing('students', $attributes);

        $this->assertNotInstanceOf(Student::class, $user->refresh()->role);
    }

}
