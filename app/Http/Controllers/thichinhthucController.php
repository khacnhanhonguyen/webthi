<?php

namespace App\Http\Controllers;

use App\Models\CauHoi;
use App\Models\DeThi;
use App\Models\DiemCuocThi;
use Illuminate\Http\Request;

class thichinhthucController extends Controller
{
    //
    public function startPractice($de_thi_id)
    {
        $deThi = DeThi::find($de_thi_id);

        // Retrieve the list of participants sorted by points and time
        $participants = DiemCuocThi::where('de_thi_id', $de_thi_id)
            ->orderByDesc('diem')
            ->orderBy('thoi_gian_thi')
            ->get();

        // Kiểm tra xem người dùng đã thi hay chưa
        $user = auth()->user();
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
                'message' => 'Bạn đã tham gia cuộc thi này.',
                'diemCuocThi' => $diemCuocThi,
                'participants' => $participants,
            ]);
        }


        // Assuming 'de_thi_id' is the ID of the practice  you want to use
        $deThi = DeThi::find($de_thi_id);

        // Assuming you have a method in your model to get random questions
        $randomQuestions = CauHoi::where('de_thi_id', $de_thi_id)
            ->inRandomOrder()
            ->limit(40)
            ->get();

        $start_time = now();


        return view('client.thichinhthuc', [
            'start_time' => $start_time,
            'deThi' => $deThi,
            'questions' => $randomQuestions,
        ]);
    }
    public function submitPractice(Request $request)
    {
        // Lấy danh sách câu trả lời từ form
        $answers = $request->input('answers', []);

        // Lấy danh sách câu hỏi từ database
        $questionIds = array_keys($answers);
        $questions = CauHoi::whereIn('id', $questionIds)->get();

        $start_time = $request->input('start_time');
        $de_thi_id = $request->input('de_thi_id');
        $end_time = now();
        $thoi_gian_lam_bai = $end_time->diffInSeconds($start_time);

        // Khởi tạo biến điểm
        $socaudung = 0;

        // Kiểm tra câu trả lời của từng câu hỏi và tính điểm
        foreach ($questions as $question) {
            // Lấy danh sách câu trả lời cho câu hỏi hiện tại
            $answersForQuestion = $question->cauTraLois;

            // Kiểm tra từng câu trả lời và tính điểm
            foreach ($answersForQuestion as $answer) {
                $selectedAnswerId = (int)$answers[$question->id];

                // Kiểm tra câu trả lời có đúng hay không
                if ($answer->dung_sai && $answer->id == $selectedAnswerId) {
                    // Cộng điểm nếu câu trả lời đúng
                    $socaudung++;
                }
            }
        }

        // Tính điểm dựa trên tổng số câu hỏi
        $totalQuestions = 40;
        $phanchamdung = ($socaudung / $totalQuestions) * 100;
        $diem = $socaudung * 0.25;

        DiemCuocThi::create([
            'user_id' => auth()->user()->id,
            'de_thi_id' => $de_thi_id,
            'diem' => $diem,
            'thoi_gian_thi' => $thoi_gian_lam_bai,
        ]);
        // Lưu kết quả vào database hoặc thực hiện các hành động khác nếu cần
        // ...

        // Trả về kết quả
        return view('client.ketqua', [
            'socaudung' => $socaudung,
            'de_thi_id'=>$de_thi_id,
            'diem' => $diem,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'thoi_gian_lam_bai' => $thoi_gian_lam_bai,
            'totalQuestions' => $totalQuestions,
            'phanchamdung' => $phanchamdung,
        ]);
    }
}
