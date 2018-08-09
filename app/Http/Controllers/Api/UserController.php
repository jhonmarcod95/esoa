<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function generateHash(Request $request){

//        $users = User::where('id', '714')->get();
//        foreach ($users as $user) {
//            $pword = str_random(5);
//            $password = bcrypt($pword);
//
//            $id = $user->id;
//
//            $update = User::find($id);
////            $update->pword = $pword;
//            $update->password = $password;
//            $update->save();
//
//            return [$pword, bcrypt($pword)];
//        }

    }
}
