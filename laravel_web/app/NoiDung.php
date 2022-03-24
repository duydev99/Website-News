<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoiDung extends Model
{
    protected $table = 'noidung';
    protected $guarded = [];
    protected $primaryKey   = 'nd_id';
}
