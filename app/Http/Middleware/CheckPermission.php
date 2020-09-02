<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\RolePermission;


class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$moduel_id,$permission_id)
    {

            $role_id=Auth::user()->role_id;
            $data=RolePermission::where('permission_id',$permission_id)
            ->where('role_id',$role_id)
            ->where('moduel_id',$moduel_id)
            ->first();
            if($data){
                return true;
            }else{
                return false;
            }

    }
}
