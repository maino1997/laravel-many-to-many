<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'HTML', 'color' => 'danger'],
            ['name' => 'CSS', 'color' => 'primary'],
            ['name' => 'Javascript', 'color' => 'warning'],
            ['name' => 'PHP', 'color' => 'secondary'],
            ['name' => 'Vue', 'color' => 'success'],
            ['name' => 'Java', 'color' => 'info']
        ];

        foreach ($categories as $category) {
            $new_category = new Category();
            $new_category->name = $category['name'];
            $new_category->color = $category['color'];
            $new_category->save();
        }
    }
}
