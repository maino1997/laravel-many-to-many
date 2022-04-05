<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\User;



class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_ids = User::pluck('id')->toArray();
        $category_ids = Category::pluck('id')->toArray();

        for ($i = 0; $i < 4; $i++) {
            $post = new Post();

            $post->title = $faker->text(20);
            $post->content = $faker->sentence();
            $post->image = $faker->imageUrl(250, 250);
            $post->slug = Str::slug($post->title, '-');
            $post->category_id = Arr::random($category_ids);
            $post->user_id = Arr::random($user_ids);


            $post->save();
        }
    }
}
