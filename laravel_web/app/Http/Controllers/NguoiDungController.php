<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\NguoiDung;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class NguoiDungController extends Controller
{

    public function index()
    {
        return DB::table('nguoidung')->get();
    }

    function getLogin(){
        return view('dangnhap');
    }
    function postLogin(Request $request){
        $username = $request->get('txtUsername');
        $password = $request->get('txtPassword');
        $rs = DB::table('nguoidung')->where('nd_taikhoan',$username)->where('nd_matkhau',md5($password))->count();
        if($rs>0){
            $getUser = DB::table('nguoidung')->where('nd_taikhoan',$username)->value('nd_id');
            $getName = DB::table('nguoidung')->where('nd_taikhoan',$username)->value('nd_hoten');
            $getType = DB::table('nguoidung')->where('nd_taikhoan',$username)->value('nd_loai');
            $request->session()->put('info', $getUser);
            $request->session()->put('name', $getName);
            if($getType == 0){
                $request->session()->put('type', 0);
            }
            else if($getType == 1){
                $request->session()->put('type', 1);
            }
            else{
                $request->session()->put('type', 2);
            }
            
            return redirect(route('home'));
        }else{
            $request->session()->put('error', true);
            return redirect(route('getLogin'));
        }
    }

    function Register(Request $request){
        $name = $request->get('txtRegisterName');
        $username = $request->get('txtRegisterUsername');
        $password = $request->get('txtRegisterPassword');
        
        $exist = DB::table('nguoidung')->where('nd_taikhoan',$username)->count();
        if($exist > 0){
            $request->session()->put('exist', true);
            return redirect(route('register'));
        }else{
            DB::table('nguoidung')
            ->insert([
                'nd_hoten'=>$name,
                'nd_taikhoan'=>$username,
                'nd_matkhau'=>md5($password),
                'nd_loai'=>2
            ]);
            return redirect(route('getLogin'));
        }
    }


    public function edit($id){
        return DB::table('nguoidung')->where('nd_id',$id)->get();
    }
    
    public function update(Request $request, $id){
        $username= DB::table('nguoidung')->where('nd_taikhoan',$request->get('nd_taikhoan'))->count();
        if($username > 0){
             return "Tài khoản đã tồn tại";
        }else{
             $user = DB::table('nguoidung')->where('nd_id',$id)->update([
                 'nd_hoten' => $request->get('nd_hoten'),
                 'nd_taikhoan' => $request->get('nd_taikhoan'),
                 'nd_matkhau' => md5($request->get('nd_matkhau'))
             ]);
             return "Cập nhật thành công";
        }
    }

    public function add(Request $request){
       $username= DB::table('nguoidung')->where('nd_taikhoan',$request->get('nd_taikhoan'))->count();
       if($username > 0){
            return "Tài khoản đã tồn tại";
       }else{
            $user = DB::table('nguoidung')->insert([
                'nd_hoten' => $request->get('nd_hoten'),
                'nd_taikhoan' => $request->get('nd_taikhoan'),
                'nd_matkhau' => md5($request->get('nd_matkhau')),
                'nd_loai' => $request->get('nd_loai')
            ]);
            return "Tạo mới thành công";
       }
    }

    function delete($id){
        DB::table('nguoidung')->where('nd_id',$id)->delete();
        return "Đã xóa";
    }
}
