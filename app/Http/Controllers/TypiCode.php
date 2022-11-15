<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypiCode extends Controller
{
    public function index()
    {
	   $uname = "";// we may need this variable later.
       return view('typicode',compact('uname'));
    }
}