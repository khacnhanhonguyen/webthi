<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeThi;
use App\Models\CauHoi;
use App\Models\CauTraLoi;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class thithuController extends Controller
{
    public function startPracticeTest($de_thi_id)
    {
        // Assuming 'de_thi_id' is the ID of the practice test you want to use
        $deThi = DeThi::find($de_thi_id);

        // Assuming you have a method in your model to get random questions
        $randomQuestions = CauHoi::where('de_thi_id', $de_thi_id)
            ->inRandomOrder()
            ->limit(40)
            ->get();

        $start_time = now();


        return view('client.thithu', [
            'start_time' => $start_time,
            'deThi' => $deThi,
            'questions' => $randomQuestions,
        ]);
    }

    // You may also create a method to handle the submission of the practice test
    public function submitPracticeTest(Request $request)
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
