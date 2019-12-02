<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class RelationshipController
{
    public function friend()
    {
        if (Auth::check()) {
            return view('friend');
        }
    }
}
