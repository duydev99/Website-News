<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    protected $guarded = [];
    protected $primaryKey   = 'img_id';
}
