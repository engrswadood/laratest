<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

/*namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repositories\User\UserInterface as UserInterface;


class UserController extends Controller
{


    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }


 // Display a listing of the resource. @return \Illuminate\Http\Response
    public function index()
    {
        $users = $this->user->getAll();
        return view('users.index',['users']);
    }


    // Display a listing of the resource. @return \Illuminate\Http\Response
    public function show($id)
    {
        $user = $this->user->find($id);
        return view('users.show',['user']);
    }


  // Display a listing of the resource. @return \Illuminate\Http\Response
    public function delete($id)
    {
        $this->user->delete($id);
        return redirect()->route('users');
    }
}
*/