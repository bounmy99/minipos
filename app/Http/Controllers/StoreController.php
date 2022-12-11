<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Intervention\Image\Facades\Image;
class StoreController extends Controller
{
    public function index(){

        // $store = Store::orderBy('id','desc');
        // return $store;
        $search = \Request::get('search');
        $store = Store::orderBy('id','desc')
        ->where('name','LIKE',"%{$search}%")
        ->paginate(15)
        ->toArray();
        return array_reverse($store);
    }
    public function add(Request $Request){
        try{

            if($Request->file('file')){

                $upload_path = "assets/img/images";
                $generation_new_name = time().'.'.$Request->file->getClientOriginalExtension();
                $image = $Request->file('file');
                $img = Image::make($image->getRealPath());
                $img->resize(800,null,function($constraint){
                    $constraint->aspectRatio();
                });

                $img->save($upload_path.'/'.$generation_new_name);

            }else{
                $generation_new_name = "";
            }

            $store = new Store();
            $store->name = $Request->name;
            $store->image = $generation_new_name;
            $store->amount = $Request->amount;
            $store->prices_buy = $Request->prices_buy;
            $store->prices_sell = $Request->prices_sell;
            $store->save();

            $success = true;
            $message ="ບັນທຶກຂໍ້ມູນສຳເລັດ";
        }catch(\illuminate\Database\QueryException $ex){
            $success = false;
            $message = $ex->geMessage;
        }

        $response = [
            "success" => "$success",
            "message" => "$message"
        ];

        return response()->json($response);
    }

    public function edit($id){
        $store = Store::find($id);
        return response()->json($store);
    }

    public function update($id, Request $Request){
        try{
            $store = Store::find($id);

            if($Request->file('file')){

                $upload_path = "assets/img/images";

                if($store->image!=''){
                    if(file_exists($upload_path.'/'.$store->image)){
                        unlink($upload_path.'/'.$store->image);
                    }
                }

                $generation_new_name = time().'.'.$Request->file->getClientOriginalExtension();
                $image = $Request->file('file');
                $img = Image::make($image->getRealPath());
                $img->resize(800,null,function($constraint){
                    $constraint->aspectRatio();
                });

                $img->save($upload_path.'/'.$generation_new_name);
                $store->update([
                    'name' =>$Request->name,
                    'image' =>$generation_new_name,
                    'amount'=>$Request->amount,
                    'prices_buy'=>$Request->prices_buy,
                    'prices_sell'=>$Request->prices_sell,
                ]);

            }else{
                $generation_new_name = "";
                $store->update([
                    'name' =>$Request->name,
                    'amount'=>$Request->amount,
                    'prices_buy'=>$Request->prices_buy,
                    'prices_sell'=>$Request->prices_sell,
                ]);
            }

            
            
            $success = true;
            $message ="ອັບເດດຂໍ້ມູນສຳເລັດ";
        }catch(\illuminate\Database\QueryException $ex){
            $success = false;
            $message = $ex->geMessage;
        }
        $response = [
            "success" => "$success",
            "message" => "$message"
        ];
        return response()->json($response);
    }

    public function delete($id){
        try{
            $store = Store::find($id);
            $store->delete();
            $success = true;
            $message ="ລົບຂໍ້ມູນສຳເລັດ";
        }catch(\illuminate\Database\QueryException $ex){
            $success = false;
            $message = $ex->geMessage;
        }
        $response = [
            "success" => "$success",
            "message" => "$message"
        ];
        return response()->json($response);
    }
}
