<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\BinhLuan;
use app\BaiViet;
use app\NguoiDung;
use Illuminate\Support\Facades\DB;
class BinhLuanController extends Controller
{

    public function index(){
        return DB::table('binhluan')
        ->join('baiviet','baiviet.bv_id','=','binhluan.bv_id')
        ->join('nguoidung','nguoidung.nd_id','=','binhluan.nd_id')
        ->orderBy('bl_id','DESC')
        ->get();
    }

    public function add(Request $request,$id){
        DB::table('binhluan')
        ->insert([
            'bl_noidung'=>$request->get('bl_noidung'),
            'bl_thoigian'=>now(),
            'bv_id'=>$id,
            'nd_id'=>$request->get('nd_id')
        ]);
    }

    function delete($id){
        DB::table('binhluan')->where('bl_id',$id)->delete();
        return "Đã xóa";
    }
}
