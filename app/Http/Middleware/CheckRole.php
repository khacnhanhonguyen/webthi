<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            // Kiểm tra giá trị cột "phanquyen"
            $userRole = Auth::user()->phanquyen;

            // Kiểm tra nếu là admin hoặc user có quyền cần thiết
            if ($userRole == $role) {
                return $next($request);
            }

            // Nếu không đúng quyền, có thể chuyển hướng hoặc trả về lỗi
            return abort(403, 'Unauthorized action.');
        }

        // Cho phép người dùng chưa đăng nhập tiếp tục xử lý request
        return redirect()->route('route.login');
    }
}
