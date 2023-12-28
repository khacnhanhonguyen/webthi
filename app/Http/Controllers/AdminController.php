<?php

namespace App\Http\Controllers;

use App\Models\CauHoi;
use App\Models\CauTraLoi;
use App\Models\DeThi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function showtrangadmin()
    {
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
        ], [
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
        $imagePath = public_path("images/{$deThi->anh_de_thi}");
        if ($deThi->anh_de_thi && File::exists($imagePath)) {
            File::delete($imagePath);
        }
        // Thực hiện xóa đề thi, ví dụ:
        $deThi->delete();

        return redirect()->route('admin.dethi.show')->with('success', 'Đề thi đã được xoá thành công.');
    }
    public function taoDethi()
    {
        return view('admin.dethi.taodethi');
    }

    public function taoDethi_process(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'anh_de_thi' => 'image', // Giả sử chỉ cho phép ảnh với dung lượng tối đa là 2MB
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau',
            'gio' => 'required|integer|min:0',
            'phut' => 'required|integer|min:0',
            'mo_ta_cuoc_thi' => 'nullable|string',
        ]);

        // Lưu đề thi vào cơ sở dữ liệu
        $deThi = new DeThi();
        $deThi->tieu_de = $request->input('tieu_de');
        $deThi->ngay_bat_dau = $request->input('ngay_bat_dau');
        $deThi->ngay_ket_thuc = $request->input('ngay_ket_thuc');
        $deThi->mo_ta_cuoc_thi = $request->input('mo_ta_cuoc_thi');
        $moThi = $request->has('mo_thi') ? true : false;
        $deThi->mo_thi = $moThi;
        // Tạo thư mục public/images nếu chưa tồn tại
        if (!file_exists(public_path('images'))) {
            mkdir(public_path('images'), 0755, true);
        }

        // Xử lý upload ảnh nếu có
        if ($request->hasFile('anh_de_thi')) {
            $file = $request->file('anh_de_thi');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '_' . time() . '.' . $extension;

            // Di chuyển file đến thư mục public/images
            $file->move(public_path('images'), $fileName);

            $deThi->anh_de_thi =  $fileName;
        }

        // Tính thời gian làm bài từ giờ và phút
        $gio = $request->input('gio');
        $phut = $request->input('phut');
        $thoiGianLamBai = $gio * 60 * 60 + $phut * 60;
        $deThi->thoi_gian_lam_bai = $thoiGianLamBai;

        $deThi->save();

        return redirect()->route('admin.dethi.show')->with('success', 'Đề thi đã được tạo thành công.');
    }
    public function editDeThi($id)
    {
        $deThi = DeThi::findOrFail($id);
        // Có thể thêm logic xử lý khác nếu cần
        return view('admin.dethi.edit', ['deThi' => $deThi]);
    }

    public function updateDeThi(Request $request, $id)
    {
        $deThi = DeThi::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'anh_de_thi' => 'image', // Giả sử chỉ cho phép ảnh với dung lượng tối đa là 2MB
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau',
            'gio' => 'required|integer|min:0',
            'phut' => 'required|integer|min:0',
            'mo_ta_cuoc_thi' => 'nullable|string',
        ]);
        $moThi = $request->has('mo_thi') ? true : false;
        // Cập nhật thông tin đề thi
        $deThi->tieu_de = $request->input('tieu_de');
        $deThi->ngay_bat_dau = $request->input('ngay_bat_dau');
        $deThi->ngay_ket_thuc = $request->input('ngay_ket_thuc');
        $deThi->mo_ta_cuoc_thi = $request->input('mo_ta_cuoc_thi');

        // Xử lý upload ảnh nếu có
        if ($request->hasFile('anh_de_thi')) {
            // Xóa ảnh cũ
            if (file_exists(public_path($deThi->anh_de_thi))) {
                unlink(public_path($deThi->anh_de_thi));
            }

            // Upload ảnh mới
            $file = $request->file('anh_de_thi');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '_' . time() . '.' . $extension;
            $file->move(public_path('images'), $fileName);
            $deThi->anh_de_thi =  $fileName;
        }

        // Tính thời gian làm bài từ giờ và phút
        $gio = $request->input('gio');
        $phut = $request->input('phut');
        $thoiGianLamBai = $gio * 60 * 60 + $phut * 60;
        $deThi->mo_thi = $moThi;
        $deThi->thoi_gian_lam_bai = $thoiGianLamBai;

        $deThi->save();

        return redirect()->route('admin.dethi.show')->with('success', 'Đề thi đã được cập nhật thành công.');
    }

    //câu hỏi
    public function showDanhSachCauHoi($de_thi_id)
    {
        // Lấy danh sách câu hỏi của đề thi có ID là $de_thi_id
        $cauHoiList = CauHoi::where('de_thi_id', $de_thi_id)->get();

        // Truyển dữ liệu đến view
        return view('admin.cauhoi.danh-sach-cau-hoi',compact('de_thi_id','cauHoiList'));
    }
    public function deleteCauHoi($id)
    {
        $cauHoi = CauHoi::findOrFail($id);

        // Xoá câu hỏi và các câu trả lời liên quan
        $cauHoi->cauTraLois()->delete();
        $cauHoi->delete();

        return redirect()->back()->with('success', 'Câu hỏi đã được xoá thành công.');
    }

    public function editCauHoi($id)
    {
        // Lấy thông tin câu hỏi và các câu trả lời liên quan
        $cauHoi = CauHoi::with('cauTraLois')->findOrFail($id);

        // Truyển dữ liệu đến view để hiển thị form sửa
        return view('admin.cauhoi.edit', compact('cauHoi'));
    }

    // Trong CauHoiController@updateCauHoi
    public function updateCauHoi(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'noi_dung' => 'required|string',
            'dap_an' => 'required|exists:cau_tra_loi,id',
        ]);

        // Cập nhật thông tin câu hỏi
        $cauHoi = CauHoi::findOrFail($id);
        $cauHoi->noi_dung = $request->input('noi_dung');
        $cauHoi->save();

        // Cập nhật thông tin các câu trả lời
        foreach ($request->input('cau_tra_lois') as $cauTraLoiData) {
            $cauTraLoi = CauTraLoi::findOrFail($cauTraLoiData['id']);
            $cauTraLoi->noi_dung = $cauTraLoiData['noi_dung'];
            $cauTraLoi->dung_sai = $cauTraLoiData['id'] == $request->input('dap_an');
            $cauTraLoi->save();
        }

        return redirect()->route('admin.dethi.danh-sach-cau-hoi', ['de_thi_id' => $cauHoi->de_thi_id])->with('success', 'Câu hỏi đã được cập nhật thành công.');
    }
    public function createCauHoi($de_thi_id)
    {
        // Lấy đề thi để truyền thông tin đề thi vào view
        $deThi = DeThi::findOrFail($de_thi_id);

        return view('admin.cauhoi.create', compact('deThi','de_thi_id'));
    }

    public function storeCauHoi(Request $request)
    {
        // Validate dữ liệu từ form
        // Validate dữ liệu
        $request->validate([
            'de_thi_id' => 'required|exists:de_thi,id',
            'noi_dung' => 'required|string',
            'cau_tra_lois' => 'required|array|min:4',
            'dap_an_dung' => 'required|integer|between:0,3', // Giả sử 0 là câu trả lời 1, 1 là câu trả lời 2, và cứ như vậy
        ]);

        // Tạo câu hỏi
        $cauHoi = new CauHoi();
        $cauHoi->de_thi_id = $request->input('de_thi_id');
        $cauHoi->noi_dung = $request->input('noi_dung');
        $cauHoi->save();

        // Lấy câu hỏi vừa được tạo
        $cauHoi = CauHoi::find($cauHoi->id);

        // Lưu các câu trả lời
        foreach ($request->input('cau_tra_lois') as $key => $cauTraLoiData) {
            $cauTraLoi = new CauTraLoi();
            $cauTraLoi->cau_hoi_id = $cauHoi->id;
            $cauTraLoi->noi_dung = $cauTraLoiData['noi_dung'];
            $cauTraLoi->dung_sai = $key == $request->input('dap_an_dung');
            $cauTraLoi->save();
        }

        // Cập nhật các câu trả lời tương ứng, bạn có thể sử dụng vòng lặp để lưu từng câu trả lời

        return redirect()->route('admin.dethi.danh-sach-cau-hoi', ['de_thi_id' => $cauHoi->de_thi_id])->with('success', 'Thêm câu hỏi thành công.');
    }
}
