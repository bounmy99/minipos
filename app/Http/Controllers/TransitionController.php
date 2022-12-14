<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transition;
use App\Models\Store;
use SNMP;

class TransitionController extends Controller
{
    public function add(Request $request){
        // return $request->ListOrder;
        try{

        foreach($request->ListOrder as $item){

        $number = 1;
        $tran = Transition::all()->sortByDesc('id')->take(1)->toArray();

        foreach( $tran as $new){
            $number = $new['tran_id'];
        }
//ເລກຕົວຢ່າງ INC00001
        if($number !=''){
            $number1 = str_replace("INC","",$number); //00001
            $number2 = str_replace("EXP","",$number1);
            $number3 = (int)$number2 + 1; //1+1=2
            $length = 5;
            $number = substr(str_repeat(0,$length).$number3, -$length ); //00002
        }

        if($request->acc_type == "income"){
            $tnum = "INC";
        }elseif($request->acc_type == "expense"){
            $tnum = "EPX";
        }
       
        $trans = new Transition();
        $trans->tran_id = $tnum.$number;
        $trans->product_id = $item["id"];
        $trans->tran_type = $request->acc_type;
        $trans->tran_detail = $item["name"];
        $trans->amount = $item["order_amount"];
        $trans->prices = $item["order_amount"] * $item['prices_sell'];
        $trans->save();
        
        $success = true;
        $message ="ຢືນຢັນການຊຳລະສຳເລັດ";

// ການຕັດສະຕັອກສີ້ນຄ້າ

        $store = Store::find($item["id"]);
// ການອັບເດດ
        $store_update = Store::where("id",$item["id"]);
        $store_update->update([
            "amount"=>$store->amount - $item["order_amount"]
        ]);

        }  
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
