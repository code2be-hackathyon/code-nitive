<?php

use Illuminate\Database\Seeder;

class QuizzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createQuizz();
    }

    public function createQuizz()
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 0; $i++){
            $quizz = new \App\Quizz();
            $quizz->label = $faker->title;
            $quizz->validationNote = 15;
            $quizz->limitNote = 10;
            $quizz->overview = $faker->text;
            $quizz->save();
        }
    }
}
