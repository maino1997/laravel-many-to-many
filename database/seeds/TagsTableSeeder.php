<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Tag;


class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tags = [
            ['name' => 'UI', 'color' => 'danger'],
            ['name' => 'FrontEnd', 'color' => 'primary'],
            ['name' => 'BackEnd', 'color' => 'warning'],
            ['name' => 'Framework', 'color' => 'secondary'],
            ['name' => 'Databse', 'color' => 'success'],
            ['name' => 'Analisi', 'color' => 'info']
        ];
        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->name = $tag['name'];
            $new_tag->color = $tag['color'];


            $new_tag->save();
        }
    }
}
