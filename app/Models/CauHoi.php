<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    use HasFactory;
    protected $table = 'cau_hoi';

    protected $fillable = ['de_thi_id', 'noi_dung'];

    public function deThi()
    {
        return $this->belongsTo(DeThi::class);
    }

    public function cauTraLoi()
    {
        return $this->hasMany(CauTraLoi::class);
    }
}
