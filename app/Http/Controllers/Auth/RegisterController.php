<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function view()
    {
        $datas = [];
        if(session()->exists('error_message')){
            $datas['error_message'] = session()->get('error_message');
            session()->remove('error_message');
        }
        return view('auth.register', $datas);
    }

    public function register(Request $request)
    {
        if(empty($request['name']) || empty($request['firstname']) || empty($request['email']) || empty($request['password']) || empty($request['password_confirmation'])){
            session()->put('error_message', 'Veuillez remplir tous les champs');
            return redirect(route('register'));
        }
        if($request['password'] !== $request['password_confirmation']){
            session()->put('error_message', 'Le mot de passe et le mot de passe de confirmation ne sont pas identiques!');
            return redirect(route('register'));
        }
        $user_check = User::where('email', '=', $request['email'])->first();
        if ($user_check !== null) {
            session()->put('error_message', 'Cette adresse e-mail est déjà utilisée');
            return redirect(route('register'));
        }
        $user = new User();
        $user->firstname = $request['firstname'];
        $user->lastname = $request['name'];
        $user->email = $request['email'];
        $user->password = encrypt($request['password']);
        $user->save();
        session()->put('message', 'Vous êtes inscrit ! Vous pouvez vous connecter');
        return redirect(route('login'));
    }
}
