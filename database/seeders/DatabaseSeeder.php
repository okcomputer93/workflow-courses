<?php

namespace Database\Seeders;

use App\Models\Professor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Professor::factory()->create()
            ->user()->create(
                User::factory()->raw([
                    'name' => 'Jhon Doe',
                    'email' => 'jhon@example.com'
                ])
            );

        $this->call([
            CourseSeeder::class
        ]);
    }
}
