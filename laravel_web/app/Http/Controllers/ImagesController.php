<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Images;
use Illuminate\Support\Facades\DB;
class ImagesController extends Controller
{
    public function add(Request $request, $id){
        if($request->hasFile('img')){
            $dirImg = __DIR__."\..\..\..\public\img\\";
            $file = $request->file('img');
            
            $fileGoc = $file->getClientOriginalName();
    
            $desFile = $id."_".$fileGoc;
            $file->move($dirImg,$desFile);
            DB::table('images')->insert(
                [
                    'img_source'=>$desFile,
                    'bv_id'=>$id
                ]
            );
            return $fileGoc;
        }
    }

    public function edit($id){
        return DB::table('images')->where('bv_id',$id)->get();
    }

    public function update(Request $request,$id,$idbv){
        if($request->hasFile('img')){
            $dirImg = __DIR__."\..\..\..\public\img\\";
            $file = $request->file('img');
            
            $fileGoc = $file->getClientOriginalName();
    
            $desFile = $idbv."_".$fileGoc;
            $file->move($dirImg,$desFile);
            DB::table('images')
            ->where('img_id',$id)
            ->update(
                [
                    'img_source'=>$desFile
                ]
            );
            return "Cập nhật thành công";
        }
    }
}
