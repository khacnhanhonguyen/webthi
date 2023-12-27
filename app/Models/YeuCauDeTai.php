<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuCauDeTai extends Model
{

    use HasFactory;
    protected $table = 'yeu_cau_de_tais';
    protected $fillable = ['nguoi_duyet_id', 'user_id','duong_dan_file','trang_thai','ten'];
    public function nguoiNop()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nguoiDuyet()
    {
        return $this->belongsTo(User::class, 'nguoi_duyet_id');
    }
}
