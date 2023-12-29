<?php

namespace Database\Seeders;

use App\Models\CauHoi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CauHoiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $duLieuJSON = file_get_contents(storage_path('app/ket_qua.json'));
        $duLieu_ketqua = json_decode($duLieuJSON, true);
        $cacCauHoiId = array_column($duLieu_ketqua, 'cau_hoi_id');

        $duLieuJSON_cauhoi = file_get_contents(storage_path('app/cau_hoi.json'));
        $duLieu_cauhoi = json_decode($duLieuJSON_cauhoi, true);

        $cacCauHoiLoc = array_filter($duLieu_cauhoi, function ($cauHoi) use ($cacCauHoiId) {
            return in_array($cauHoi['id'], $cacCauHoiId);
        });

        // Duyệt qua dữ liệu và chèn vào cơ sở dữ liệu
        foreach ($cacCauHoiLoc as $cauHoi) {
            CauHoi::create([
                'id'=>$cauHoi['id'],
                'de_thi_id' => 3,
                'noi_dung' => $cauHoi['question'],
            ]);
        }
    }
}
