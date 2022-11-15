<?php

namespace App\Http\Controllers;

/*use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;*/
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
//use App\Http\Controllers\Auth;
use Auth;

class NameFinder extends Controller
{
	public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
	 

     
    public function findDetails($namepar)
    {
		if(Auth::user()->name == $namepar){
			$user = $this->user->find($namepar);
			echo json_encode($user);
		}
		else
			echo "Unauthorized access";
		//$user = $this->user->find($namepar);
		//echo json_encode($user);
		//$users = $this->user->getAll();
        //return view('users.index',['users']);
    }
}
