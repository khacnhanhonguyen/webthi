<?php

namespace App\Http\Controllers;

use App\Models\YeuCauDeTai;
use Illuminate\Http\Request;

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
            'file_path' => 'uploads/' . $fileName,
            'status' => 'pending', // Trạng thái ban đầu là chờ duyệt
        ]);

        return redirect()->route('yeucaudetai.create')->with('success', 'Yêu cầu đã được nộp.');
    }

    public function approve(Request $request, $id)
    {
        // Duyệt yêu cầu
        $yeuCau = YeuCauDeTai::findOrFail($id);
        $yeuCau->update(['status' => 'approved']);

        // Thông báo cho người dùng hoặc thực hiện các hành động khác nếu cần

        return redirect()->route('admin.dashboard')->with('success', 'Yêu cầu đã được duyệt.');
    }

}
