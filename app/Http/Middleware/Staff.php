<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class Staff
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		Request::is();
		if(Auth::check())
		{
			if(Auth::user()->isStaff())
			{
				return $next($request);
			}
			abort(403);
		}
		return redirect('login');
	}
}
