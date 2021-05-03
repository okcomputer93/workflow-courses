<?php


namespace Tests\Setup;


use App\Models\Course;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;

class CourseFactory
{
    protected $professor;
    protected $storage;
    protected $faker;

    public function __construct(Faker $faker) {
        $this->faker = $faker;
    }

    public function ownedBy(User $professor): CourseFactory
    {
        $this->professor = $professor;
        return $this;
    }

    public function withStorage(String $storage)
    {
        Storage::fake($storage);
        return $this;
    }

    public function raw()
    {
        return Course::factory()->raw([
            'miniature' => UploadedFile::fake()->image('lesson-1.jpg', 200, 200)
        ]);

    }

    public function create()
    {
        return Course::factory()->create();
    }

}
