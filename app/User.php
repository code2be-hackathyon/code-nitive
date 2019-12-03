<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $table = 'user';

    protected $fillable = [
        'id','email','firstname', 'lastname', 'password', 'api_token'
    ];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function user_quizz() {
        $user_quizzs_not_analyzed = UserQuizz::where('user_id', '=', $this->id)->get();
        $user_quizzs = [];
        foreach($user_quizzs_not_analyzed as $user_quizz){
            $iterations = $user_quizz->iterations;
            $user_quizzs[] = ["user_quizz" => $user_quizz, "quizz" => $user_quizz->quizz, "iterations" => $iterations, "nbIterations" => count($iterations)];
        }
        return $user_quizzs;
    }


    public function save(array $options = [])
    {
        if (is_null($this->id)){
            $this->id = Str::random(32);
        }
        if (is_null($this->api_token)){
            $this->api_token = Str::random(64);
        }
        parent::save($options);
    }
}
