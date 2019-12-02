<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quizz extends Model
{
    protected $table = 'quizz';

    protected $fillable = ['id','label','owner_id','validationNote','limitNote','overview'];

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
        $this->id = Str::random(32);
        parent::save();
    }
}
