<?php

namespace Factum\Http\Middleware;

use Closure;
use Factum\Models\Company;
use Illuminate\Support\Facades\Auth;

class HasCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {		
		if(Company::where('user_id',Auth::user()->id)->count() == 0){
				return redirect(layer_url())->with('error', 'El usuario no tiene asociada ninguna empresa'); 
		}    
		
		return $next($request); 
    }
}
