<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauTraLoi extends Model
{
    use HasFactory;
    protected $table = 'cau_tra_loi';

    protected $fillable = ['cau_hoi_id', 'noi_dung', 'dung_sai'];

    public function cauHoi()
    {
        return $this->belongsTo(CauHoi::class);
    }

}
