<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeThi;
use App\Models\CauHoi;
use App\Models\CauTraLoi;

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



        return view('client.thithu', [
            'deThi' => $deThi,
            'questions' => $randomQuestions,
        ]);
    }

    // You may also create a method to handle the submission of the practice test
    public function submitPracticeTest(Request $request)
    {
        // Process submitted answers and calculate the score
        // ...
    }
}
