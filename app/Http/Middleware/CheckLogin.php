<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        // nếu user đã đăng nhập
        if (Auth::guard('admin')->check())
        {
            $user = Auth::guard('admin')->user();
            // check quyền admin && trạng thái hoạt động
            if ($user->is_active == 1 )
            {
                return $next($request);
            } else {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login');
            }
        }

        return redirect()->route('admin.login');
    }
}
