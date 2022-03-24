<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NguoiDung extends Model
{
    protected $table = 'nguoidung';
    // protected $fillable     = ['nd_hoten', 'nd_taikhoan', 'nd_matkhau', 'nd_loai'];
    // protected $guarded      = ['nd_id'];
    protected $guarded = [];
    protected $primaryKey   = 'nd_id';
}
