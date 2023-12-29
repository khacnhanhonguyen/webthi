<?php

namespace App\Http\Controllers;

use App\Models\CauHoi;
use App\Models\DeThi;
use App\Models\DiemCuocThi;
use Illuminate\Http\Request;

class thongtincuocthiController extends Controller
{
    public function xemcuocthi($de_thi_id)
    {
        $deThi = DeThi::find($de_thi_id);

        // Retrieve the list of participants sorted by points and time
        $participants = DiemCuocThi::where('de_thi_id', $de_thi_id)
            ->orderByDesc('diem')
            ->orderBy('thoi_gian_thi')
            ->get();

        // Kiểm tra xem người dùng đã thi hay chưa
        $user = auth()->user();
        if ($user) {
            $hasTakenPractice = DiemCuocThi::where('user_id', $user->id)
            ->where('de_thi_id', $de_thi_id)
            ->exists();
            $diemCuocThi = DiemCuocThi::where('user_id', $user->id)
                ->where('de_thi_id', $de_thi_id)
                ->first(); // Lấy điểm cuộc thi của người dùng (nếu có)

            if ($hasTakenPractice) {
                // Người dùng đã thi, chuyển hướng hoặc hiển thị trang thông báo
                return view('client.xemthongtincuocthi', [
                    'deThi' => $deThi,
                    'diemCuocThi' => $diemCuocThi,
                    'participants' => $participants,
                ]);
            }else{
                return view('client.xemthongtincuocthi', [
                    'deThi' => $deThi,
                    'participants' => $participants,
                ]);
            }
        }else{
            return view('client.xemthongtincuocthi', [
                'deThi' => $deThi,
                'participants' => $participants,
            ]);
        }

    }
}
