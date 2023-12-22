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
            'anh_de_thi'=>'wallpaperflare.com_wallpaper_1.jpg',
            'ngay_bat_dau' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('de_thi')->insert([
            'tieu_de' => 'Tìm hiểu Nghị quyết Đại hội Đoàn toàn quốc lần thứ XII',
            // Add other fields if needed
            'anh_de_thi'=>'wallpaperflare.com_wallpaper.jpg',
            'ngay_bat_dau' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
