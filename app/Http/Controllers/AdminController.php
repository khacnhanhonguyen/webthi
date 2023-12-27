<?php

namespace App\Http\Controllers;

use App\Models\DeThi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showtrangadmin(){
        return view("admin.trangchu");
    }

    public function showUser()
    {
        $users = User::all();
        return view('admin.user.tranglistuser', ['users' => $users]);
    }
    public function deleteUser($id)
    {
        $userToDelete = User::find($id);

        // Kiểm tra xem người dùng đang thao tác có quyền để xoá hay không
        if (auth()->user()->id === $userToDelete->id) {
            return redirect()->route('admin.showlistuser')->with('error', 'Bạn không thể xoá chính mình.');
        }

        // Kiểm tra xem người đang thao tác có quyền admin (phanquyen = 2) hay không
        if (auth()->user()->phanquyen == 2) {
            // Cho phép admin (phanquyen = 2) xoá giáo vụ (phanquyen = 1)
            if ($userToDelete->phanquyen == 1) {
                $userToDelete->delete();
                return redirect()->route('admin.showlistuser')->with('success', 'Người dùng đã được xoá thành công.');
            } else {
                return redirect()->route('admin.showlistuser')->with('error', 'Bạn không có quyền xoá người này.');
            }
        }

        // Kiểm tra xem người đang thao tác có quyền giáo vụ (phanquyen = 1) hay không
        if (auth()->user()->phanquyen == 1) {
            // Giáo vụ (phanquyen = 1) chỉ có thể xoá người dùng thường (phanquyen = 0)
            if ($userToDelete->phanquyen == 0) {
                $userToDelete->delete();
                return redirect()->route('admin.showlistuser')->with('success', 'Người dùng đã được xoá thành công.');
            } else {
                return redirect()->route('admin.showlistuser')->with('error', 'Bạn không có quyền xoá người này.');
            }
        }

        // Các trường hợp còn lại, không có quyền xoá
        return redirect()->route('admin.showlistuser')->with('error', 'Bạn không có quyền xoá người dùng.');
    }

    public function showCreateForm()
    {
        return view('admin.user.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|regex:/^(?=.*[A-Z])(?=\S+$)/',
            'role' => 'required', // Adjust roles based on your setup
        ],[
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một ký tự viết hoa.',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phanquyen' => $request->input('role'),
        ]);

        return redirect()->route('admin.showlistuser')->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $user = User::find($id);

        // Kiểm tra nếu không tìm thấy người dùng
        if (!$user) {
            abort(404); // Hoặc có thể thực hiện các xử lý khác tùy thuộc vào yêu cầu của bạn
        }

        return view('admin.user.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Bỏ qua email của người đang chỉnh sửa
            'role' => 'required',
        ]);

        $user = User::find($id);

        // Kiểm tra nếu không tìm thấy người dùng
        if (!$user) {
            abort(404);
        }

        // Cập nhật thông tin người dùng
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phanquyen' => $request->input('role'),
        ]);

        return redirect()->route('admin.showlistuser')->with('success', 'User updated successfully.');
    }


    //trang de tai
    public function showDethi()
    {
        $listDeThi = DeThi::all(); // Lấy danh sách đề thi

        return view('admin.dethi.danhsachdethi', compact('listDeThi'));
    }
    public function deleteDeThi($id)
    {
        $deThi = DeThi::findOrFail($id);

        // Thực hiện xóa đề thi, ví dụ:
        $deThi->delete();

        return redirect()->route('admin.dethi.show')->with('success', 'Đề thi đã được xoá thành công.');
    }

}
