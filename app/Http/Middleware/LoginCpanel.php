<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class LoginCpanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($req, Closure $next)
    {
        if($req){
            $credentials=['password'=>$req->password,'username'=>$req->username,'admin_type'=>"cpanel"];
            if (Auth::guard('cpanel')->attempt($credentials)) {
                return $next($request);
            }
        }
        return redirect('cpanel/logout');
    }
}
