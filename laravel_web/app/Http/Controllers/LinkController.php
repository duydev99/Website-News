<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Link;
use Illuminate\Support\Facades\DB;
class LinkController extends Controller
{
    public function add(Request $request){
        DB::table('link')->insert([
            'link_url'=>$request->get('link_url'),
            'bv_id'=>$request->get('bv_id')
        ]);
        return $request->get('link_url');
    }

    public function edit($id){
        $edit = DB::table('link')->where('bv_id',$id)->get();
        
        return response([
            'edit'=>$edit,
            'idbv'=>$id
        ]);
    }

    public function update(Request $request,$id){

        $coutLink = DB::table('link')->where('bv_id',$request->get('bv_id'))->count();

        if($coutLink>0){
            DB::table('link')
            ->where('link_id',$id)
            ->update([
                'link_url'=>$request->get('link_url')
            ]);
        }else{
            DB::table('link')
            ->insert([
                'link_url'=>$request->get('link_url'),
                'bv_id'=>$request->get('bv_id')
            ]);
        }


        return "Cập nhật thành công";
    }
}
