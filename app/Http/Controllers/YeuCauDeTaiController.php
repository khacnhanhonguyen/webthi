<?php

namespace App\Http\Controllers;

use App\Models\DeThi;
use App\Models\YeuCauDeTai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YeuCauDeTaiController extends Controller
{
    // app/Http/Controllers/YeuCauDeTaiController.php
    public function create()
    {

        // Hiển thị form để nộp yêu cầu
        return view('admin.yeucau.create');
    }
    public function showdanhsachyeucaudetai(){
        // Hiển thị danh sách yêu cầu chờ duyệt cho quản trị viên
        $yeuCauList = YeuCauDeTai::all();

        return view('admin.yeucau.showdanhsachyeucaudetai', compact('yeuCauList'));
    }
    public function showdanhsachyeucaudetaicuagiaovien(){
        // Lấy danh sách yêu cầu của giáo viên hiện tại
        $yeuCauList = YeuCauDeTai::where('user_id', Auth::user()->id)->get();

        return view('admin.yeucau.danhsachyeucauGiaovien', compact('yeuCauList'));
    }
    public function store(Request $request)
    {
    // Validate dữ liệu yêu cầu
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // Giả sử chỉ chấp nhận file PDF
            // Thêm các quy tắc kiểm tra khác nếu cần
        ]);

        // Upload file
        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $fileName);

        // Tạo bản ghi yêu cầu mới
        YeuCauDeTai::create([
            'user_id' => auth()->user()->id,
            'duong_dan_file' =>  $fileName,
            'trang_thai' => 'cho_duyet', // Trạng thái ban đầu là chờ duyệt
            'ten' => $request->ten, // Thêm tên đề tài từ form
        ]);

        return redirect()->route('giaovien.yeucau.show')->with('success', 'Yêu cầu đã được nộp và chờ duyệt.');
    }
    public function duyet(Request $request, $id)
    {
        // Kiểm tra quyền truy cập hoặc điều kiện duyệt
        // ...

        $yeuCau = YeuCauDeTai::findOrFail($id);
        $yeuCau->update(['nguoi_duyet_id' => Auth::user()->id]);
        $yeuCau->update(['trang_thai' => 'da_them']);

        // Thông báo cho người dùng hoặc thực hiện các hành động khác nếu cần

        return redirect()->route('admin.yeucau.show')->with('success', 'Yêu cầu đã được duyệt.');
    }

    public function downloadPDF(YeuCauDeTai $yeuCauDeTai)
    {
        // Kiểm tra trạng thái yêu cầu hoặc quyền truy cập nếu cần
        // ...

        $filePath = public_path('uploads/' . $yeuCauDeTai->duong_dan_file);

        return response()->file($filePath);
    }
}
