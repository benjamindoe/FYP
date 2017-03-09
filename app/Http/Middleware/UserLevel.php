<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserLevel
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param string $role 0 = unauth, 1 = student, 2 = $level
	 * @return mixed
	 */
	public function handle($request, Closure $next, $role)
	{
		if(Auth::check())
		{
			$level;
			switch ($role)
			{
				case 'super':
					$level = 4;
					break;
				case 'staff':
					$level = 3;
					break;
				case 'parent':
					$level = 2;
					break;
				case 'student':
					$level = 1;
					break;
				default:
					$level = 0;
					break;
			}
			if(Auth::user()->userLevel() >= $level)
			{
				return $next($request);
			}
			return abort(403);
		}
		return redirect()->guest('login');
	}
}
