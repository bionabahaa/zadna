<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class LoginAdmin
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
        if($req->username && $req->password){
            $credentials=['password'=>$req->password,'username'=>$req->username,'admin_type'=>"cpanel"];
            if (Auth::guard('admin')->attempt($credentials)) {
                return $next($request);
            }
        }
        // dd('asdasd');
        return redirect('admin/logout');
    }
}
