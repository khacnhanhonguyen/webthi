<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\registerRequest;

class loginController extends Controller
{
    //
    public function showtranglogin(){
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|min:6',
        ],[
            'email.required' => 'Email là bắt buộc',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu tối thiểu là 6 ký tự',
        ]);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'] ,
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Kiểm tra giá trị cột "phanquyen"
            $userRole = Auth::user()->phanquyen;

            // Kiểm tra nếu là admin
            if ($userRole == 1) {
                return redirect()->route('admin.dashboard');
            }

            // Kiểm tra nếu là user với quyền 0
            elseif ($userRole == 0) {
                return redirect()->route('route.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email hoặc Mật Khẩu không đúng.',
        ]);
    }
    public function logoutProcess(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('route.login');
    }

    public function create(registerRequest $request)
    {
        $user=new User();
        $user->name=$request->cname;
        $user->email=$request->cemail;
        $user->password=bcrypt($request->cpassword);
        $user->save();

        // Redirect to the home page or wherever you want
        return redirect()->route('route.login')->with('Thongbao','Tạo tài khoản thành công.');
    }
}
