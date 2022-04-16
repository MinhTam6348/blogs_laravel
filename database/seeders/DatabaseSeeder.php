<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
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
        //Disable foreign key constraints for users and enable it again.
        Schema::disableForeignKeyConstraints();
        \App\Models\User::truncate();
        \App\Models\Role::truncate();
        \App\Models\Category::truncate();
        \App\Models\Post::truncate();
        \App\Models\Tag::truncate();
        \App\Models\Comment::truncate();
        \App\Models\Image::truncate();

        Schema::enableForeignKeyConstraints();

        // Create roles and users
        \App\Models\Role::factory(1)->create();
        \App\Models\Role::factory(1)->create(['name' => 'admin']);
        $users = \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'role_id'=>2
        ]);

        foreach ($users as $user) {
            $user->image()->save(\App\Models\Image::factory()->make());
        }

        \App\Models\Category::factory(10)->create();
        \App\Models\Category::factory()->create(['name'=>'Uncategorized']);

        $posts = \App\Models\Post::factory(50)->create();
        
        \App\Models\Comment::factory(100)->create();
        \App\Models\Tag::factory(10)->create();

        foreach ($posts as $post) {
            $tag_ids = [];

            $tag_ids[] = \App\Models\Tag::all()->random()->id;
            $tag_ids[] = \App\Models\Tag::all()->random()->id;
            $tag_ids[] = \App\Models\Tag::all()->random()->id;

            $post->tags()->sync($tag_ids );
            $post->image()->save(\App\Models\Image::factory()->make());
        }
    }
}
