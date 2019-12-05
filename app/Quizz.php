<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function score($response)
    {
        $questions = $this->questions();
        $scores = [];
        $note = 0;
        $total = 0;
        $errors =[];

        foreach ($questions as $question) {
            if (isset($response[$question->id])){
                $answer = new Answer();
                $answer->user_id = Auth::user()->id;
                $answer->question_id = $question->id;
                $answer->userResponse = json_encode($response[$question->id]);
                $answer->save();

                $scores[$question->id] = $question->value;
                $total += $question->value;

                if (json_decode($answer->userResponse) == $question->correctResponses()){
                    $note += $scores[$question->id];
                }
                else{
                    $errors[] = $question->id;
                }
            }
        }
        if ($total > 0){
            $note = ($note/$total)*20; // note to /20 points
        }
        return ['note'=>$note,'errors'=>$errors];
    }
}
