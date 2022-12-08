<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function register(Request $request){
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->save();
    }
}
