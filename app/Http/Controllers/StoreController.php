<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Transition;
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
            
            $product_id_new = $store->id;


            // ບັນທຶກ ລາຍຈ່າຍ ສັ່ງຊື້ສິນຄ້າ
            $number = 1;
            $tran = Transition::all()->sortByDesc('id')->take(1)->toArray();

            foreach($tran as $new){
                $number = $new["tran_id"];
            }
            // ຕົວຢ່າງ INC00001
            if($number !=''){
                $number1 = str_replace("INC","",$number); // 00001
                $number2 = str_replace("EXP","",$number1);
                $number3 = (int)$number2+1; // 1+1 = 2
                $length = 5;
                $number = substr(str_repeat(0,$length).$number3, - $length); //00002
            }

            if($Request->acc_type == "income") {
                $tnum = "INC";
            } elseif($Request->acc_type == "expense") {
                $tnum = "EXP";
            }

            $trans = new Transition();
            $trans->tran_id = $tnum.$number;
            $trans->product_id = $product_id_new;
            $trans->tran_type = $Request->acc_type;
            $trans->tran_detail = "ນຳເຂົ້າສິນຄ້າໃໝ່ ".$Request->name;
            $trans->amount = $Request->amount;
            $trans->price = $Request->amount * $Request->prices_buy;
            $trans->save();

            $success = true;
            $message ="ບັນທຶກຂໍ້ມູນສຳເລັດ";
        }catch(\illuminate\Database\QueryException $ex){
            $success = false;
            $message = $ex->getMessage; 
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
