<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExplicitRole
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next, string $role)
	{
		if(Auth::check())
		{

			if(Auth::user()->role() === $role)
			{
				if(Auth::user()->staff !== null)
					$_ENV['school'] = Auth::user()->staff->school;
				return $next($request);
			}
			return abort(403);;
		}
		return redirect()->guest('login');
	}
}
