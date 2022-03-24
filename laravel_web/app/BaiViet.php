<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = 'baiviet';
    protected $guarded = [];
    protected $primaryKey   = 'bv_id';
}
