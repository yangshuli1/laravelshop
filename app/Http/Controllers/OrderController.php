<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }
    public function orderadd(Request $request)
	{	
		$use=auth()->user();
		$uid=$use->id;
		$nerder=$request->input('nerder');
		$ner=explode("-", $nerder);
		array_shift($ner);
		$id=implode($ner, "' or cart.id='");
		$arr=DB::select("select cart.id,cart.gid,cart.num,cart.goods_name,cart.attr_name,goodsatt.price,goodsatt.sn_number from cart join goodsatt on cart.gid=goodsatt.id  where cart.u_id='$uid' and cart.id='$id'");
		$ar=DB::select("select * from useraddress where defau='ok'");
		$str['data']=$arr;
		$str['name']=$ar;
		return response()->json($str);
	}
	 public function order(Request $request)
	{	
         $catr_id=$request->input('catr_id');
         $cid=explode(",", $catr_id);
         $data=date("Y-m-d");
		 $use=auth()->user();
		 $uid=$use->id;
		 $address=$request->input('name');
		 $ord = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
		 $ar=DB::insert("insert into ordere(`time`,`status`,`u_id`,`address`,`ord`)value('$data','0','$uid','$address','$ord')");
		 $order_id=DB::getPdo()->lastInsertId();

		 for ($i=0; $i < count($cid)-1 ; $i++) {
		 $ar=DB::select("select cart.id,cart.gid,cart.num,cart.goods_name,cart.attr_name,goodsatt.price,goodsatt.sn_number from cart join goodsatt on cart.gid=goodsatt.id where cart.id='$cid[$i]'");
		 $h_goods=$ar[0]->goods_name;
		 $h_id=$ar[0]->gid;
		 $h_type=$ar[0]->attr_name;
		 $price=$ar[0]->price;
		 $num=$ar[0]->num;
		 $order_id=$order_id;
		 $arr=DB::insert("insert into order_details(`h_goods`,`h_id`,`h_type`,`price`,`num`,`order_id`)value('$h_goods','$h_id','$h_type','$price','$num','$order_id')");
		 }
		 // 	DB::delete("delete from cart where cart.id='$caid'");

		 return response()->json($ord);
	}
}