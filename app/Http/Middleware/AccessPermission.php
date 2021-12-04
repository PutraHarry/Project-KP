<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\AdminModel;
use App\PermissionModel;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $expression)
    {
        $admin_jabatan = Auth::guard('admin')->user()->id_jabatan;

        $permission = PermissionModel::where('nama', $expression)->where('id_jabatan', $admin_jabatan)->first();
        if ($permission) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
