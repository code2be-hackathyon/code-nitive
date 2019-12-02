<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    protected $table = 'question';

    protected $fillable = ['label','response','quizz_id','value','order','value'];

    public $timestamps = false;

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function save(array $options = [])
    {
        if(is_null($this->id)){
            $this->id = Str::random(32);
        }
        parent::save($options);
    }

    public function responses()
    {
        return json_decode($this->response)[0]->responses;
    }

    public function correctResponses()
    {
        return json_decode($this->response)[0]->correctResponses;
    }
}
