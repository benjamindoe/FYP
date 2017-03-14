<?php

namespace App\Http\Middleware;

use Closure;

class StudentProfile
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
		if(Auth::check())
		{
			switch(Auth::user()->userLevel())
			{
				case 1:
					return 'student';
					break;
				case 2:
					return 'parent';
					break;
				case 3:
					return 'staff';
					break;
				case 4:
					return 'super';
					break;
			}
			if(Auth::user()->staff && Auth::user()->staff->role === $role)
			{
				$_ENV['school'] = Auth::user()->staff->school;
				return $next($request);
			}
			return abort(403);
		}
		return redirect()->guest('login');
	}
}
