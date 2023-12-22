<?php

namespace Database\Seeders;

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

        $duLieuJSON = file_get_contents(storage_path('app/cau_hoi_data_tong_hop.json'));
        $duLieu = json_decode($duLieuJSON, true);

        // Duyệt qua dữ liệu và chèn vào cơ sở dữ liệu
        foreach ($duLieu as $item) {
            DB::table('cau_hoi')->insert([
                'de_thi_id' => $item['de_tai_ID'],
                'id'=>$item['id'],
                'noi_dung' => $item['noi_dung'],
                // Thêm các trường khác nếu cần
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
