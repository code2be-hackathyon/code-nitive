<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    protected $table = 'question';

    protected $fillable = ['label','response','quizz_id','value','order','value'];

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
        $this->id = Str::random(32);
        parent::save($options);
    }
}
