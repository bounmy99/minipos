<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transition;
use App\Models\Store;

class RepotController extends Controller
{
    public function index(Request $request){

        $month_type = $request->month_type;
        $date = $request->dmy;

        $d = explode("-",$date)[2];
        $m = explode("-",$date)[1];
        $y = explode("-",$date)[0];

        if($month_type=="d"){
            $income = Transition::where("tran_type","income")
                ->whereYear("created_at","=",$y)
                ->whereMonth("created_at","=",$m)
                ->whereDay("created_at","=",$d)
                ->get();

            $expense = Transition::where("tran_type","expense")
                ->whereYear("created_at","=",$y)
                ->whereMonth("created_at","=",$m)
                ->whereDay("created_at","=",$d)
                ->get();
    
        }else if($month_type=="m"){
            $income = Transition::where("tran_type","income")
            ->whereYear("created_at","=",$y)
            ->whereMonth("created_at","=",$m)
            ->get();

        $expense = Transition::where("tran_type","expense")
            ->whereYear("created_at","=",$y)
            ->whereMonth("created_at","=",$m)
            ->get();
        }else{
            $income = Transition::where("tran_type","income")
            ->whereYear("created_at","=",$y)
            ->get();

        $expense = Transition::where("tran_type","expense")
            ->whereYear("created_at","=",$y)
            ->get();
        }

        $response = [
            "income" =>$income,
            "expense" =>$expense
        ];

        return response()->json($response);
        
    }
    
    public function dash(){
        
            $income = Transition::where("tran_type","income")->get();
            $expense = Transition::where("tran_type","expense")->get();
            $store = Store::where("amount","!=","0")->get();

            $response = [
                'income'=> $income,
                'expense'=> $expense,
                'store'=> $store
            ];
    
            return response()->json($response);
    }
}
