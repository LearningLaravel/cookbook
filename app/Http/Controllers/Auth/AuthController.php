<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Socialite;
use Auth;
use Illuminate\Http\Request;
use Response;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'facebook_id' => $data['email'],
        ]);
    }

    public function redirectToFacebook()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function getFacebookCallback()
    {

        $data = Socialite::with('facebook')->user();
        $user = User::where('email', $data->email)->first();

        if (!is_null($user)) {
            Auth::login($user);
            $user->name = $data->user['name'];
            $user->facebook_id = $data->id;
            $user->save();
        } else {
            $user = User::where('facebook_id', $data->id)->first();
            if (is_null($user)) {
                // Create a new user
                $user = new User();
                $user->name = $data->user['name'];
                $user->email = $data->email;
                $user->facebook_id = $data->id;
                $user->save();
            }
            Auth::login($user);
        }
        return redirect('/')->with('success', 'Successfully logged in!');
    }

    public function postRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:2',
            'password' => 'required|alphaNum|min:6|same:password_confirmation',
        ]);

        if ($validator->fails()) {
            $message = ['errors' => $validator->messages()->all()];
            $response = Response::json($message, 202);
        } else {

            // Create a new user

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'facebook_id' => $request->email
            ]);
            $user->save();

            Auth::login($user);

            $message = ['success' => 'Thank you for joining us!', 'url' => '/', 'name' => $request->name];
            $response = Response::json($message, 200);
        }
        return $response;
    }

    public function getRegister()
    {
        return view('auth/ajax_register');
    }

    public function getLogin()
    {
        return view('auth/ajax_login');
    }

    public function postLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $message = ['errors' => $validator->messages()->all()];
            $response = Response::json($message, 202);
        } else {
            $remember = $request->remember? true : false;

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

                $message = ['success' => 'Love to see you here!', 'url' => '/'];

                $response = Response::json($message, 200);
            } else {
                $message = ['errors' => 'Please check your email or password again.'];
                $response = Response::json($message, 202);
            }
        }

        return $response;
    }


}
