<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserQuizz extends Model
{
    protected $table = "user_quizz";
    protected $fillable = ['user_id', 'quizz_id', 'note'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quizz()
    {
        return $this->belongsTo(Quizz::class, 'quizz_id');
    }

    public function iterations()
    {
        return $this->hasMany(Iteration::class, 'user_quizz_id', 'id');
    }

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
}
