<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $table = 'user';

    protected $fillable = [
        'id','email','firstname', 'lastname', 'password', 'api_token'
    ];

    public static function users()
    {
        return User::all();
    }

    public function save(array $options = [])
    {
        if (is_null($this->api_token)){
            $this->id = Str::random(32);
            $this->api_token = Str::random(64);
        }
        parent::save($options);
    }
}
