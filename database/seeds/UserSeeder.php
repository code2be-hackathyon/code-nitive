<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUser();
    }

    public function createUser()
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++){
            $user = new \App\User();
            $user->email = $faker->email;
            $user->firstname = $faker->firstName;
            $user->lastname = $faker->lastName;
            $user->password = encrypt('password');
            $user->save();
        }
    }
}
