<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
        if(is_null($this->id)){
            $this->id = Str::random(32);
        }
        parent::save();
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order')->get();
    }

    public function tags()
    {
        preg_match_all("/(#\w+)/", $this->label, $tags);
        return $tags[0];
    }

    public function titleWithoutHashtag()
    {
        $tags = $this->tags();
        $title = $this->label;
        foreach ($tags as $tag){
            $title = str_replace($tag,'',$title);
        }
        return $title;
    }
}
