<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Iteration;
use App\Question;
use App\Quizz;
use App\UserQuizz;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizzController extends Controller
{
    public function homeQuizz()
    {
        if (Auth::check()){
            $quizzs = Quizz::all();
            $homeQuizzs = [];
            foreach ($quizzs as $quizz){
                if (Auth::user()->isQuizzAtUser($quizz->id)) {
                    $homeQuizzs[] = $quizz;
                }
            }
            return view('homeQuizz', ['quizzs'=> $homeQuizzs]);
        }
        return redirect(route('loginView'));
    }

    public function activeQuizz()
    {
        if (Auth::check()){
            $user = Auth::user();
            $user_quizzs = $user->user_quizz();
            usort($user_quizzs, function($a,$b){
                return $a['user_quizz']->note - $b['user_quizz']->note ;
            });
            $modalClass = session()->get('modalClass');
            session()->remove('modalClass');
            return view('activeQuizz', ['quizzs' => $user_quizzs,'modalClass'=>$modalClass]);
        }
        return redirect(route('loginView'));
    }

    public function archiveQuizz()
    {
        if (Auth::check()){
            return view('archiveQuizz');
        }
        return redirect(route('loginView'));
    }

    // permet d'afficher la partie 'admin' pour la demo
    public function checkView() {
        return view('admin.checkquizz');
    }

    // permet d'effectuer les checks d'iterations
    public function checkIterations()
    {
        $user_quizz = UserQuizz::all();
        foreach ($user_quizz as $oneUserQuizz){
            $note = $oneUserQuizz->note;

            $iterations = $oneUserQuizz->iterations;
            $nbIterations = count($iterations);
            $decrementing = [
                1 => 2, // A la premiere iteration il perd 2 points
                2 => 1, // A la seconde iteration il perd 1 point
                3 => 0.5]; // A la troisieme iteration ik perd 0.5 point

            $newNote = $note;

            if($nbIterations <= 2){
                $newNote = $note - $decrementing[$nbIterations];
            }
            $newNote = ($newNote < 0) ? 0 : $newNote;
            $oneUserQuizz->note = $newNote;
            $oneUserQuizz->save();
        }
        return redirect(route('admin.checkquizz.view'));
    }

    public function questions($id)
    {
        if (Auth::check()){
            $quizz = Quizz::where('id',$id)->first();
            return view('questions',['questions'=>$quizz->questions(),'quizz'=>$quizz]);
        }
        return view('auth.login');
    }

    public function validateResponses($id, Request $request)
    {
        $quizz = Quizz::where('id',$id)->first();
        $response = $request->post();
        $modalClass = 'swalDefaultError';
        $user_quizz_exists = UserQuizz::where('user_id',Auth::user()->id)->where('quizz_id',$quizz->id)->first();

        if (!$user_quizz_exists){
            $userQuizz = new UserQuizz();
            $userQuizz->user_id = Auth::user()->id;
            $userQuizz->quizz_id = $quizz->id;
            $userQuizz->save();
        }

        $note = $quizz->score($response);

        if ($note >= $quizz->validationNote){
            $iterations = new Iteration();
            if(!$user_quizz_exists){
                $iterations->user_quizz_id = $userQuizz->id;
            }
            else {
                $iterations->user_quizz_id = $user_quizz_exists->id;
            }
            $iterations->order = 1;
            $iterations->date = date('Y-m-d H:i:s');
            $iterations->note = $note;
            $iterations->save();
            $modalClass = 'swalDefaultSuccess';
        }

        if ($user_quizz_exists){
            $user_quizz_exists->note = $note;
            $user_quizz_exists->save();
        }
        else{
            $userQuizz->note = $note;
            $userQuizz->save();
        }

        session()->put(['modalClass'=>$modalClass]);

        return redirect(route('activeQuizz'));
    }
}
