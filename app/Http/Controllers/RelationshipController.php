<?php


namespace App\Http\Controllers;


use App\Relationship;
use App\User;
use Illuminate\Support\Facades\Auth;

class RelationshipController
{
    public function friends()
    {
        if (Auth::check()) {
            return view('friend');
//            $relationships = Relationship::where('receiver_id' OR 'sender_id', Auth::user()->id)->where('confirm',1);
//            $friends = User::where('id',$relationships->receiver_id OR $relationships->sender_id);
//            return view('friends',['friends',$friends]);
        }
        return view('auth.login');
    }

}
