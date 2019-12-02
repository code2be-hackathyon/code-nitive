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
            }
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
        return view('auth.login', $datas);
    }

    public function logout()
    {
        $datas = [];
        if (Auth::check()){
            Auth::logout();
        }
        return view('auth.login', $datas);
    }
}
