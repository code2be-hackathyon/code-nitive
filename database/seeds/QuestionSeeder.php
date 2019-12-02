<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createQuestion();
    }

    public function createQuestion()
    {
        $question = new \App\Question();
        $question->label = 'Quels sont les fabriquants de smartphones ?';
        $question->quizz_id = 'F2pj9FHvSot78X5hz8MjzlxgQuunkE2f';
        $question->value = 3;
        $question->order = 4;
        $question->type = 'QCM';
        $datas = ['responses'=>['Samsung','Huawei','Microsoft'],'correctResponses'=>[1,2]];
        $question->response = json_encode($datas);
        $question->save();
    }
}
