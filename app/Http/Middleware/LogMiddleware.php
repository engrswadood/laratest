<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Closure;

class LogMiddleware {
   public function handle($request, Closure $next) {//incomingref
		if(Auth::user())
			Log::info("__ ".Auth::user()->name."\n\n");
		//Log::info("__ ".Auth::user()->name."\n\n");
		return $next($request);
   }
}