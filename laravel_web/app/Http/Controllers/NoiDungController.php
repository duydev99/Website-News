<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\NoiDung;
use Illuminate\Support\Facades\DB;
class NoiDungController extends Controller
{
    function add(Request $request){
        DB::table('noidung')->insert(
            [
                'nd_noidung'=>$request->get('nd_noidung'),
                'bv_id'=>$request->get('bv_id')
            ]
        );
        $id = DB::table('noidung')->where('bv_id',$request->get('bv_id'))->max('nd_id');
        return DB::table('noidung')->where('nd_id',$id)->value('nd_noidung');
    }
}
