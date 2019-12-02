<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Iteration extends Model
{

    protected $table = 'iteration';

    protected $fillable = ['user_quizz_id','order','date','note'];

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
