<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Level;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $categories = Category::factory()->count(3)->create();
       $levels = Level::factory(3)->count(3)->create();

        Course::factory()
            ->count(100)
            ->state(
                new Sequence(
                    function () use($categories, $levels) {
                        return [
                            'category_id' => $categories->random(),
                            'level_id' => $levels->random()
                        ];
                    }
                )
            )->create([
                'miniature' => 'miniatures/dpaQHbDNqnENarEsD00gXjuaCkdraSLk4Aq5AgvT.jpg',
            ])->each(function ($course) {
                Comment::factory()->count(3)->create([
                    'course_id' => $course->id
                ]);
                $course->refreshRate();
            });
    }
}


