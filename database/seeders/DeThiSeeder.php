<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeThiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('de_thi')->insert([
            'tieu_de' => 'Tìm hiểu Nghị quyết Đại hội Đoàn toàn quốc lần thứ XII',
            // Add other fields if needed
            'anh_de_thi'=>'658c92c4da6a1_1703711428.jpg',
            'ngay_bat_dau' => now(),
            'thoi_gian_lam_bai' => 2700, // 45 phút
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('de_thi')->insert([
            'tieu_de' => 'Tư Tưởng Hồ Chí Minh',
            // Add other fields if needed
            'anh_de_thi'=>'z5019369421539_0bfcf20d408adfea7a43c6e6f563f6eb.jpg',
            'ngay_bat_dau' => now(),
            'thoi_gian_lam_bai' => 2700, // 45 phút
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
