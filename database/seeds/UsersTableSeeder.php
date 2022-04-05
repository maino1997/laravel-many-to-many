<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = new User();
        $user->name = 'Sasha';
        $user->email = 'sasha@new.it';
        $user->password = bcrypt('password');

        $user->save();

        for ($i = 0; $i < 5; $i++) {
            $new_user =  new User();

            $new_user->name = $faker->firstName();
            $new_user->email = $faker->email();
            $new_user->password = bcrypt($faker->password(5, 10));

            $new_user->save();
        }
    }
}
