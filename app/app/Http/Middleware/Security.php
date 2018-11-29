<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Security
{
    /**
     * Middleware para dar seguridad a las urls.
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // tratamiento de acceso restringido.
        if($request->user()->rol != 'ADMINISTRADOR'){
            if (Auth::guard($guard)->check()) {
                if($request->ajax() || $request->expectsJson()){
                    return response('Unautorized', 401);
                }else{
                    //return redirect()->guest('login');
                    return redirect('/login');
                }                
            }
        }
        return $next($request);
    }

}
