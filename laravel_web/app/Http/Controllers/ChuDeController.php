<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\ChuDe;
use app\BaiViet;
use Illuminate\Support\Facades\DB;
class ChuDeController extends Controller
{
    function index(){
        return DB::table('chude')->get();
    }

    function add(Request $request){
        $cd = DB::table('chude')->where('cd_chude',$request->get('cd_chude'))->count();
        if($cd > 0){
            return "Chủ đề đã tồn tại";
        }else{
            DB::table('chude')->insert(['cd_chude'=>$request->get('cd_chude')]);
            return "Tạo mới thành công";
        }
    }

    function edit($id){
        return DB::table('chude')->where('cd_id',$id)->get();
    }

    function update(Request $request, $id){
        $cd = DB::table('chude')->where('cd_chude',$request->get('cd_chude'))->count();
        if($cd > 0){
            return "Chủ đề đã tồn tại";
        }else{
            $chude = DB::table('chude')->where('cd_id',$id)->update(['cd_chude'=>$request->get('cd_chude')]);
            return "Cập nhật thành công";
        }
    }

    function delete($id){
        $baiviet = DB::table('baiviet')->where('cd_id',$id)->count();
        if($baiviet > 0){
            return "Chủ đề đang được sử dụng";
        }else{
            DB::table('chude')->where('cd_id',$id)->delete();
            return "Đã xóa";
        }

    }
}
