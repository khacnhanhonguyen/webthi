<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CauHoi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {


        // $this->call(DeThiSeeder::class);
        $this->call(CauHoiSeeder::class);
        $this->call(CauTraLoiSeeder::class);
    }
}
