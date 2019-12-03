<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table = 'relationship';

    protected $fillable = ['id','sender_id','receiver_id','confirm'];

    public $timestamps = false;

    public function sender()
    {
        return $this->belongsToMany(User::class,'sender_id')->get();
    }

    public function receiver()
    {
        return $this->belongsToMany(User::class,'receiver_id')->get();
    }

    public function friends()
    {
        return User::where('id',$this->receiver()->id)->where('confirm',1)->get();
    }
}
