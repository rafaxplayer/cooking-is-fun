<?php namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( Auth::check() && Auth::user()->range=='admin' )
        {
            return $next($request);
        }

        return redirect('/home')->with('message','no tienes permisos para acceder a esta zona');
	}



}
