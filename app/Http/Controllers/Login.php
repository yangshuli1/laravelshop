<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class login extends Controller
{
    public function show()
    {
        return view('login.index');
    }
    function del(Request $request){
        $request->session()->forget('name');
        return redirect()->action('Login@show');
    }
    public function index(Request $request)
    {
       // echo $neme= $request->session()->get('name');
        $name = $request->input('name');
        $pass = $request->input('pass');
        $user = DB::select("select * from user where user_name='$name'and password='$pass'");
        if (empty($name)||empty($pass)) {
           $arr=['yan'=>'1','status'=>'0','data'=>"用户名密码不能为空"];
            echo $json=json_encode($arr);
        }else{
            if (empty($user)) {
                $arr=['yan'=>'1','status'=>'0','data'=>"用户名密码错误"];
                echo $json=json_encode($arr);
            }else{
                  $request->session()->put('name', $name);
                 // $neme= $request->session()->get('name');
                $arr=['yan'=>'1','status'=>'1','data'=>"登录成功"];
                echo $json=json_encode($arr);
            }
        }
        
    }

}
?>