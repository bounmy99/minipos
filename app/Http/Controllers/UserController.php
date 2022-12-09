<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use function Symfony\Component\VarDumper\Dumper\esc;

class UserController extends Controller
{
    public function register(Request $request){

        try{

           $check_email = User::where("email",$request->email); // check duplicate email address 
           if($check_email->count()){

            $success = false;
            $message ="ອີເມວນີ້:". $request->email ."ໄດ້ລົງທະບຽນແລ້ວ!";

           }else{

            $user = new User();
            $user->name = $request->username;
            $user->email = $request->email;
            $user->password = hash::make($request->password);
            $user->save();
            
            $success = true;
            $message ="ລົງທະບຽນສຳເລັດ";

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

    public function login(Request $request){
        $check_user_login = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if(Auth::attempt($check_user_login)){
            $success = true;
            $message ="ເຂົ້າສູ່ລະບົບສຳເລັດ";
        }else{
            $success = false;
            $message ="ອີເມວ ຫຼື ລະຫັດຜ່ານບໍ່ຖຶກຕ້ອງ";
        }

        $response = [
            "success" => $success,
            "message" => $message
        ];

        return response()->json($response);
    }

    public function logout(){
        
        
        try{
            Session::flush();

             $success = true;
             $message ="ອອກລະບົບສຳເລັດ";
 
            
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
