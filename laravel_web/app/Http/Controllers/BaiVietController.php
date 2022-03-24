<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\BaiViet;
use app\ChuDe;
use app\NguoiDung;
use app\NoiDung;
use app\Link;
use app\Images;
use Illuminate\Support\Facades\DB;

class BaiVietController extends Controller
{

    public function index(){
        return DB::table('baiviet')
        ->where('bv_status','=',1)
        ->join('nguoidung', 'bv_tacgia', '=', 'nguoidung.nd_id')
        ->join('chude', 'baiviet.cd_id', '=', 'chude.cd_id')
        ->join('images', 'baiviet.bv_id', '=', 'images.bv_id')
        ->orderBy('baiviet.bv_id','DESC')
        ->get();
    }

    public function detail($id){
        $viewCurrent =DB::table('baiviet')->where('bv_id',$id)->value('bv_view');
        DB::table('baiviet')->where('bv_id',$id)->update(['bv_view'=>$viewCurrent+1]);

        $count = DB::table('link')->where('bv_id',$id)->count();

        if($count>0){
            $detail = DB::table('baiviet')
            ->where('baiviet.bv_id',$id)
            ->join('nguoidung', 'bv_tacgia', '=', 'nguoidung.nd_id')
            ->join('chude', 'baiviet.cd_id', '=', 'chude.cd_id')
            ->join('link', 'baiviet.bv_id', '=', 'link.bv_id')
            ->join('images', 'baiviet.bv_id', '=', 'images.bv_id')
            ->join('noidung', 'baiviet.bv_id', '=', 'noidung.bv_id')
            ->get();
        }else{
            $detail = DB::table('baiviet')
            ->where('baiviet.bv_id',$id)
            ->join('nguoidung', 'bv_tacgia', '=', 'nguoidung.nd_id')
            ->join('chude', 'baiviet.cd_id', '=', 'chude.cd_id')
            ->join('images', 'baiviet.bv_id', '=', 'images.bv_id')
            ->join('noidung', 'baiviet.bv_id', '=', 'noidung.bv_id')
            ->get();
        }


        $comments = DB::table('binhluan')
        ->where('bv_id',$id)
        ->join('nguoidung', 'binhluan.nd_id', '=', 'nguoidung.nd_id')
        ->orderBy('bl_id','DESC')
        ->get();

        return response([
            'infoBaiViet' => $detail,
            'comments' => $comments
        ], 200);
        
        // return view('baiviet_detail')->with([
        //     'infoBaiViet' => $detail,
        //     'comments' => $comments
        // ]);
    }

    public function see($id){
        $count = DB::table('link')->where('bv_id',$id)->count();

        if($count>0){
            $detail = DB::table('baiviet')
            ->where('baiviet.bv_id',$id)
            ->join('nguoidung', 'bv_tacgia', '=', 'nguoidung.nd_id')
            ->join('chude', 'baiviet.cd_id', '=', 'chude.cd_id')
            ->join('link', 'baiviet.bv_id', '=', 'link.bv_id')
            ->join('images', 'baiviet.bv_id', '=', 'images.bv_id')
            ->join('noidung', 'baiviet.bv_id', '=', 'noidung.bv_id')
            ->get();
        }else{
            $detail = DB::table('baiviet')
            ->where('baiviet.bv_id',$id)
            ->join('nguoidung', 'bv_tacgia', '=', 'nguoidung.nd_id')
            ->join('chude', 'baiviet.cd_id', '=', 'chude.cd_id')
            ->join('images', 'baiviet.bv_id', '=', 'images.bv_id')
            ->join('noidung', 'baiviet.bv_id', '=', 'noidung.bv_id')
            ->get();
        }
        return $detail;
    }


    public function top10(){
        return DB::table('baiviet')
        ->where('bv_status','=',1)
        ->join('images', 'baiviet.bv_id', '=', 'images.bv_id')
        ->orderBy('baiviet.bv_view','DESC')
        ->limit(10)
        ->get();
    }

    function baivietlienquan($id){
        return DB::table('baiviet')
        ->where('cd_id',$id)
        ->where('bv_status','=',1)
        ->join('images', 'baiviet.bv_id', '=', 'images.bv_id')
        ->orderBy('baiviet.bv_id','DESC')
        ->limit(5)
        ->get();
    }

    function search_chude($id){
        return DB::table('baiviet')
        ->where('baiviet.cd_id',$id)
        ->where('bv_status','=',1)
        ->join('nguoidung', 'bv_tacgia', '=', 'nguoidung.nd_id')
        ->join('chude', 'baiviet.cd_id', '=', 'chude.cd_id')
        ->join('images', 'baiviet.bv_id', '=', 'images.bv_id')
        ->orderBy('baiviet.bv_id','DESC')
        ->get();
    }

    function search($text){
        return DB::table('baiviet')
        ->where('bv_status','=',1)
        ->where('baiviet.bv_tieude','like','%'.$text.'%')
        ->join('nguoidung', 'bv_tacgia', '=', 'nguoidung.nd_id')
        ->join('chude', 'baiviet.cd_id', '=', 'chude.cd_id')
        ->join('images', 'baiviet.bv_id', '=', 'images.bv_id')
        ->orderBy('baiviet.bv_id','DESC')
        ->get();
    }

    function status($id){
        $status = DB::table('baiviet')->where('bv_id',$id)->value('bv_status');
        if($status == 0){
            DB::table('baiviet')
            ->where('bv_id',$id)
            ->update([
                'bv_status'=>1
            ]);
        }else{
            DB::table('baiviet')
            ->where('bv_id',$id)
            ->update([
                'bv_status'=>0
            ]);
        }
    }

    function baivietTG($id)
    {
        $listBaiViet = DB::table('baiviet')
            ->where('bv_tacgia', $id)
            ->join('nguoidung', 'bv_tacgia', '=', 'nguoidung.nd_id')
            ->join('chude', 'baiviet.cd_id', '=', 'chude.cd_id')
            ->orderby('bv_id', 'DESC')
            ->get();
        return response([
            'listBaiViet' => $listBaiViet
        ], 200);
    }


    function baivietManage()
    {
        return DB::table('baiviet')
        ->join('nguoidung', 'bv_tacgia', '=', 'nguoidung.nd_id')
        ->orderby('bv_id', 'DESC')
        ->get();
    }

    function add(Request $request)
    {
        DB::table('baiviet')->insert(
            [
                'bv_tieude' => $request->get('bv_tieude'),
                'bv_thoigian' => now(),
                'bv_tacgia' => $request->get('bv_tacgia'),
                'cd_id' => $request->get('cd_id'),
                'bv_status' => 0
            ]
        );
        return DB::table('baiviet')->where('bv_tacgia', $request->get('bv_tacgia'))->max('bv_id');
    }

    function edit($id){
        $editBaiViet = DB::table('baiviet')
        ->where('baiviet.bv_id', $id)
        ->join('noidung', 'baiviet.bv_id', '=', 'noidung.bv_id')
        ->get();
        return response([
            'editBaiViet' => $editBaiViet
        ], 200);
    }

    function update(Request $request,$id){
        DB::table('baiviet')
        ->where('bv_id',$id)
        ->update([
            'cd_id'=>$request->get('cd_id'),
            'bv_tieude'=>$request->get('bv_tieude')
        ]);
        DB::table('noidung')
        ->where('bv_id',$id)
        ->update([
            'nd_noidung'=>$request->get('nd_noidung')
        ]);
        return "Cập nhật thành công";
    }

    function delete($id){
        DB::table('images')->where('bv_id',$id)->delete();
        DB::table('link')->where('bv_id',$id)->delete();
        DB::table('noidung')->where('bv_id',$id)->delete();
        DB::table('binhluan')->where('bv_id',$id)->delete();
        DB::table('baiviet')->where('bv_id',$id)->delete();
        return "Đã xóa";
    }
}
