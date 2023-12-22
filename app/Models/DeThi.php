<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeThi extends Model
{
    use HasFactory;
    protected $table = 'de_thi';

    protected $fillable = ['tieu_de'];

    public function cauHoi()
    {
        return $this->hasMany(CauHoi::class);

    }
    public function getRandomQuestions($count)
    {
        return $this->cauHois()->inRandomOrder()->limit($count)->get();
    }
    public function diemCuocThi()
    {
        return $this->morphMany(DiemCuocThi::class, 'cauhoiable');
    }
}
