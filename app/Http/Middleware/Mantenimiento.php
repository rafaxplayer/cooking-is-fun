<?php namespace App\Http\Middleware;

use Closure;
use App\Models\Settings;
use Auth;
class Mantenimiento {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(Settings::find(1)->value){

			if(Auth::check()){

				if(!Auth::user()->isAdmin()){
				
					return view('errors.503');
				}else{
					return $next($request);
				}
			}

			return view('errors.503');
			
		}
		return $next($request);
	}

}
