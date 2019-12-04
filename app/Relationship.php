<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Relationship extends Model
{
    protected $table = 'relationship';

    protected $fillable = ['id','sender_id','receiver_id','confirm'];

    public $timestamps = false;

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }


    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id')->first();
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id')->first();
    }

    public function save(array $options = [])
    {
        if (is_null($this->id)){
            $this->id = Str::random(32);
        }
        parent::save($options);
    }
}
