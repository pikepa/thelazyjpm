<?php

namespace Database\Seeders;

use App\Models\Discussion;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Peter Pike',
            'email' => 'pikepeter@gmail.com',
            'username' => 'pikepa',
            'password' => bcrypt('password')
        ]);

        User::factory(5)->create();

        Topic::factory()->create([
            'title' => 'Inertia',
            'slug' => 'inertia',
        ]);
        Topic::factory()->create([
            'title' => 'Laravel',
            'slug' => 'laravel',
        ]);
        Topic::factory()->create([
            'title' => 'Vue',
            'slug' => 'vue',
        ]);

        Discussion::factory(3)->create();

        $discussions = Discussion::get();
        //   dd($discussions);
        foreach ($discussions as $discussion) {
            Post::factory()->create([
                'discussion_id' => $discussion->id,
                'user_id' => $discussion->user_id,
                'parent_id' => null,
            ]);
        }
        foreach ($discussions as $discussion) {
            Post::factory()->create([
                'discussion_id' => $discussion->id,
                'user_id' => User::all()->random()->id,
                'parent_id' => $discussion->latestPost->id,
            ]);
        }
    }
}
