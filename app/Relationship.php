<?php


namespace App;


class Relationship
{
    protected $table = 'relationship';

    protected $fillable = ['id','sender_id','receiver_id','confirm'];

    public $timestamps = false;
}
