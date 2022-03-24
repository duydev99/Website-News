<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    protected $table = 'binhluan';
    protected $guarded = [];
    protected $primaryKey   = 'bl_id';
}
