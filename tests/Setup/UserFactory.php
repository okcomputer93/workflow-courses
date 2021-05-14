<?php


namespace Tests\Setup;


use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserFactory
{
    protected $role;

    public function __construct(Faker $faker) {
        $this->faker = $faker;
        $this->role = 'student';
    }

    public function role(String $role): UserFactory
    {
        $this->role = $role;
        return $this;
    }

    public function withStorage(String $storage): UserFactory
    {
        Storage::fake($storage);
        return $this;
    }

    public function raw(): array
    {
        $attributes = [];

        $attributes += User::factory()->raw([
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => $this->role,
            'avatar' => UploadedFile::fake()->image('my-avatar.jpg', 100, 100)
        ]);

        $attributes += $this->roleFactory()::factory()->raw();

        return $attributes;
    }

    public function create()
    {
        $role = $this->roleFactory()::factory()->create();
        $user = User::factory()->raw();
        return $role->user()->create(
            User::factory()->raw([
                'role' => null,
                'role_name' => $this->role,
            ])
        );
    }

    protected function roleFactory(): string
    {
        $className = ucwords($this->role);
        return "App\\Models\\$className";
    }

}
