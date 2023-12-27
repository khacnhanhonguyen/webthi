<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiemCuocThi extends Model
{
    use HasFactory;
    protected $table = 'diem_cuoc_thi';
    protected $fillable = ['user_id', 'de_thi_id', 'diem', 'thoi_gian_thi'];

    // Mối quan hệ với người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ với đề thi
    public function deThi()
    {
        return $this->belongsTo(DeThi::class);
    }

    // Mối quan hệ đa hình
    public function cauhoiable()
    {
        return $this->morphTo();
    }
}
