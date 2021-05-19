<?php


namespace Tests\Setup;


use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserFactory
{
    protected $role;
    protected $user;
    protected $roleAttributes;

    /**
     * UserFactory constructor.
     * @param Faker $faker
     */
    public function __construct(Faker $faker) {
        $this->faker = $faker;
        $this->role = 'student';
    }

    /**
     * Add the base for a User, the class will add a role to this.
     * @param User|null $user
     * @return $this
     */
    public function baseOn(?User $user): UserFactory
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Defines the role for a user.
     * @param String $role
     * @return $this
     */
    public function role(String $role): UserFactory
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Fakes an storage to stop polluting the real obe,
     * @param String $storage
     * @return $this
     */
    public function withStorage(String $storage): UserFactory
    {
        Storage::fake($storage);
        return $this;
    }

    /**
     * Generates raw fake data for a user based on the properties.
     * @return array
     */
    public function raw(): array
    {
        $attributes = [];

        $attributes += User::factory()->raw([
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => $this->role,
            'avatar' => UploadedFile::fake()->image('my-avatar.jpg', 100, 100)
        ]);

        $attributes += $this->roleAttributes = RoleFactory::raw($this->role);

        return $attributes;
    }

    /**
     * Creates a User.
     * @return mixed
     */
    public function create()
    {
        $role = RoleFactory::create($this->role);
        return $role->user()->create(
            $this->user ?? User::factory()->raw()
        );
    }

    public function roleAttributes()
    {
        return $this->roleAttributes;
    }

}
