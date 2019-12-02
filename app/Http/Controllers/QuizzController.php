<?php

namespace App\Http\Controllers;

use App\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizzController extends Controller
{
    public function homeQuizz()
    {
        if (Auth::check()){
            $quizzs = Quizz::all();
            return view('homeQuizz', ['quizzs'=> $quizzs]);
        }
        return view('auth.login');
    }

    public function activeQuizz()
    {
        if (Auth::check()){
            return view('activeQuizz');
        }
        return view('auth.login');
    }

    public function archiveQuizz()
    {
        if (Auth::check()){
            return view('archiveQuizz');
        }
        return view('auth.login');
    }
}
