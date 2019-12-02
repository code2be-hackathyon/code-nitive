<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Answer extends Model
{

    protected $table = 'answer';

    protected $fillable = ['question_id','user_id'];

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
