<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/quizz';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        if ($user){
            if (decrypt($user->password) == $request['password']){
                Auth::login($user);
            }else{
                session()->put('error_message', 'Identifiants invalides');
            }
        }else{
            session()->put('error_message', 'Identifiants invalides');
        }
        return redirect('/quizz');
    }

    public function view()
    {
        $datas = [];
        if(session()->exists('message')){
            $datas['message'] = session()->get('message');
            session()->remove('message');
        }
        if(session()->exists('error_message')){
            $datas['error_message'] = session()->get('error_message');
            session()->remove('error_message');
        }
        return view('auth.login', $datas);
    }

    public function logout()
    {
        if (Auth::check()){
            session()->put('message', 'Vous vous êtes déconnecté');
            Auth::logout();
        }
        return redirect(route('loginView'));
    }
}
