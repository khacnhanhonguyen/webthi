<?php

namespace Database\Seeders;

use App\Models\CauTraLoi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CauTraLoiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Đọc dữ liệu từ file JSON
        $jsonFile = storage_path('app/ket_qua.json'); // Điều chỉnh đường dẫn tùy thuộc vào nơi bạn lưu trữ file
        $jsonData = json_decode(file_get_contents($jsonFile), true);

        // Seed dữ liệu cho câu trả lời
        foreach ($jsonData as $item) {
            $options = $item['options'];

            // Duyệt qua các lựa chọn và seed vào cơ sở dữ liệu
            foreach ($options as $key => $noi_dung) {
                // Kiểm tra chữ cái đầu của $key và $item['dap_an']
                $firstLetterKey = strtoupper(substr($key, 0, 1));
                $firstLetterDapAn = strtoupper(substr($item['dap_an'], 0, 1));

                CauTraLoi::create([
                    'cau_hoi_id' => $item['cau_hoi_id'],
                    'noi_dung' => $noi_dung,
                    'dung_sai' => $firstLetterKey === $firstLetterDapAn,
                ]);
            }
        }
    }
}
