<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }
     public function tab()
    {
        //echo "123";
        $user = DB::select("select * from user ");
         $arr=['yan'=>'1','status'=>'1','data'=>$user];
         echo $json=json_encode($arr);
    }

}