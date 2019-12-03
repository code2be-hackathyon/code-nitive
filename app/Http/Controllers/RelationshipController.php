<?php


namespace App\Http\Controllers;


use App\Relationship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelationshipController
{
    public function friends()
    {
        if (Auth::check()) {
            $friendsSender = Relationship::where('sender_id', '=',Auth::user()->id)->where('confirm','=',1)->get();
            $friendsReceiver = Relationship::where('receiver_id', '=',Auth::user()->id)->where('confirm','=',1)->get();
            $friendsRequest = Relationship::where('sender_id', '=',Auth::user()->id)->where('confirm','=',0)->get();
            $friends = [];
            if ($friendsReceiver and $friendsSender !== null){
                foreach ($friendsSender as $friendSender){
                    $friends[] = $friendSender;
                }
                foreach ($friendsReceiver as $friendReceiver){
                    $friends[] = $friendReceiver;
                }
                foreach ($friendsRequest as $friendRequest){
                    $friends[] = $friendRequest;
                }
            }
            $askFriends = $this->askFriends();
            return view('friend',['friends'=>$friends,'askFriends'=>$askFriends]);
        }
        return view('auth.login');
    }

    public function askFriends()
    {
            $friendsReceiver = Relationship::where('receiver_id', '=',Auth::user()->id)->where('confirm','=',0)->get();
            $askFriends = [];
            if ($friendsReceiver !== null){
                $askFriends = $friendsReceiver;
            }
            return $askFriends;
    }
    public function addFriend(Request $request)
    {
        $friendEmail = $request->post()['email'];
        $user_check = User::where('email', '=', $request['email'])->first();
        if ($user_check === null) {
            session()->put('error_message', 'Cette adresse e-mail n\'existe pas');
            return redirect(route('friends'));
        }
        $receiver_id = User::where('email',$friendEmail)->first()->id;
        $relationship = new Relationship();
        $relationship->sender_id = Auth::user()->id;
        $relationship->receiver_id = $receiver_id;
        $relationship->confirm = 0;
        $relationship->save();
        return redirect(route('friends'));
    }

}
