<?php

namespace Tests\Setup;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Facades\Tests\Setup\UserFactory;
use Faker\Generator as Faker;

class CourseFactory
{
    protected User $professor;
    protected string $storage;
    protected Faker $faker;
    protected Category $category;
    protected Level $level;
    protected $viewers;

    /**
     * CourseFactory constructor.
     * @param Faker $faker
     */
    public function __construct(Faker $faker) {
        $this->faker = $faker;
    }

    /**
     * Add an owner to a course.
     * @param User $professor
     * @return $this
     */
    public function ownedBy(User $professor): CourseFactory
    {
        $this->professor = $professor;
        return $this;
    }

    /**
     * Fakes an storage to stop polluting the real obe,
     * @param String $storage
     * @return $this
     */
    public function withStorage(String $storage): CourseFactory
    {
        Storage::fake($storage);
        return $this;
    }

    /**
     * Defines a category for the course.
     * @param Category $category
     * @return $this
     */
    public function category(Category $category): CourseFactory
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Defines a level for the course.
     * @param Level $level
     * @return $this
     */
    public function level(Level $level): CourseFactory
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @param $viewers
     * @return $this
     */
    public function addViewers($viewers): CourseFactory
    {
        $this->viewers = $viewers;
        return $this;

    }

    /**
     * @param Course $course
     * @return void
     */
    public function saveViewers(Course $course)
    {
        if ($this->viewers) {
            if ($this->viewers instanceof Collection) {
                $course->viewers()
                    ->saveMany($this->viewers);
            }
            elseif ($this->viewers instanceof Model) {
                $course->viewers()
                    ->save($this->viewers);
            }
        }
    }

    /**
     * Generates raw fake data for a course.
     * @return array
     */
    public function raw(): array
    {
        return Course::factory()->raw([
            'miniature' => UploadedFile::fake()->image('lesson-1.jpg', 200, 200),
            'category_id' => $this->category ?? Category::factory()->create(),
            'professor_id' => $this->professor ?? UserFactory::role('professor')->create(),
            'level_id' => $this->level ?? Level::factory()->create()
        ]);

    }

    /**
     * Creates a course.
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function create()
    {
        $course = Course::factory()->create([
            'category_id' => $this->category ?? Category::factory()->create(),
            'professor_id' => $this->professor ?? UserFactory::role('professor')->create(),
            'level_id' => $this->level ?? Level::factory()->create()
        ]);

        $this->saveViewers($course);

        $course->refresh();

        return $course;
    }

}
