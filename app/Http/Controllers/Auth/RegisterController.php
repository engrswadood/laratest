<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
	 private static $UniqueUserName = [
	 'name' => "required|unique:users",
	];
	
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
     * @return \App\Models\User
     */
	protected function validateUniqueName(array $data){
		
		/*$newdata = array();

		foreach ($data as $k => $v) {
			$newdata[$k] = $v;
		}*/
	
		$validator = Validator::make($data, RegisterController::$UniqueUserName);
		 if ($validator->fails()) {
            return false;
        }
		return true;
		
	}
	
    protected function create(array $data)
    {
		//$this->validate($data, $this->UniqueUserName);
		
		if(!$this->validateUniqueName($data)){
			$error = \Illuminate\Validation\ValidationException::withMessages([
			   'field' => ['name'],
			   'error' => ['"Your name already exists in DB table.'],
			]);
			throw $error;// This error needs to be handled (It may not be part of this test)
		}
		
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
