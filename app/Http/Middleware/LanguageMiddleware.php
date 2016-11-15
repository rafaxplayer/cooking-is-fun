<?php namespace App\Http\Middleware;

use Closure;
use Session;
use App;
class LanguageMiddleware {

	protected $languages = ['en','es'];
 
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(Session::has('locale') && in_array(Session::get('locale'), $this->languages))
        {
            App::setLocale(Session::get('locale'));
        }
		return $next($request);
	}

}
