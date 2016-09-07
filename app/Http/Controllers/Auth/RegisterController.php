<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Http\Request;
use App\Mail\RegistrationRequest;
use App\Models\RegistrationRequest as RegReqModel;

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
     * Where to redirect users after login / registration.
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register_request_view() {
        return View('auth/register_request');
    }

    protected function validate_registration_request($data)
    {
        return Validator::make($data, [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:registration_requests'
        ]);
    }

    public function register_view(Request $request, $hash)
    {
        // Finding existing registration request
        $req = RegReqModel::where([
            'hash' => $hash
        ])->first();


        return View('auth/register')->with([
            'name'  => $req->username,
            'email' => $req->email
        ]);

    }


    public function register_request(Request $request)
    {

        // Variable initialization
        $model  = null;      // this is the model object to send to mail view
        $exist  = false;     // this is condition to check object already exist


        // Validation 
        $validate = $this->validate_registration_request($request->all());
        if($validate->fails()) {
            return redirect('/register_request')->withErrors($validate)->withInput();
        }

        // Checking if we already send mail before
        $regReq = RegReqModel::where([
            'email' => $request->email
        ])->get();
        if($regReq->count() == 0) {

            // If not exist, then creating new request
            $model = RegReqModel::create([
                'username' => $request->name,
                'email'    => $request->email,
                'hash'     => str_random(32)
            ]);
        } else {

            // If exist, then getting the existing one.
            $exist  = true;
            $model = $regReq->first();
        }

        Mail::to("adiechahari@gmail.com")->send(new RegistrationRequest(compact('model', 'exist')));
        
    }

}
