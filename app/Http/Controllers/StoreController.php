<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function index(){

        // $store = Store::orderBy('id','desc');
        // return $store;
        $search = \Request::get('search');
        $store = Store::orderBy('id','desc')
        ->where('name','LIKE',"%{$search}%")
        ->paginate(5)
        ->toArray();
        return array_reverse($store);
    }
    public function add(Request $Request){
        try{
            $store = new Store();
            $store->name = $Request->name;
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
            $store->update([
                'name' =>$Request->name,
                'amount'=>$Request->amount,
                'prices_buy'=>$Request->prices_buy,
                'prices_sell'=>$Request->prices_sell,
            ]);
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
