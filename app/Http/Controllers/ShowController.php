<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['shpp','getTree','ation','floor','shop','goods']]);
    }
     public function shpp()
    {
        $user = DB::select("select * from user ");
         return response()->json($user);

    }
	 private function getTree($arr,$pid = 0, $level = 0){
	       $list = [];
        foreach ($arr as $k=>$v){
            if ($v->pid == $pid){
                $v->src=$level;
                $v->sos = $this->getTree($arr,$v->id,$level+1);
                $list[] = $v;
            }
        }
        return $list;
	}
	 public function ation()
	{
	$arr=DB::select("select * from class ");
	 $ar= $this->getTree($arr);
	  return response()->json($ar);
	}
	 public function floor()
	{
	$arr1=DB::select("select kjgoods.id as gid,kjgoods.gs_name as gs_name ,floor.f_name as f_name from  floor join kjgoods on floor.gid=kjgoods.fid");
	$floor=[];
	foreach ($arr1 as $key=>$value){
            $floor[$value->f_name][]=[$value->gs_name,$value->gid];
        }
      // var_dump($floor)
        return response()->json($floor);
	}
	 public function shop(Request $request)
	{
		$id = $request->input('id');
		$arr=DB::select("select kjgoods.gs_name, attribute.name,attr_details.id,attr_details.name as b_name from kjgoods  join goods_attr  on kjgoods.id=goods_attr.goods_id join attribute on goods_attr.attr_id=attribute.id join attr_details on goods_attr.attr_details_id=attr_details.id where kjgoods.id='$id'");
		if (empty($arr)) {
		}else{
				$attr=[];
        foreach ($arr as $key => $value){
            $attr[$value->name][]=[$value->b_name,$value->id];
        }
        $ass['name']=$arr[0]->gs_name;
        $ass['data']=$attr;
        return response()->json($ass);
		}
	}
	 public function goods(Request $request)
	{
		$id = $request->input('id');
		$tid=$request->input('tid');
		$name=$request->input('name');
		$ttid=substr($tid,1);
		$arr=DB::select("select id, price from goodsatt where goods_id='$id'and goods_attr_id='$ttid'");
		$ar=DB::select("select id from users where name='$name'");
		$arr['uid']=$ar;
		return response()->json($arr);
	}
	 public function cart(Request $request)
	{
		$gid = $request->input('hid');
		$attr_name = $request->input('attr');
		$goods_name = $request->input('name');
		$use=auth()->user();
		$uid=$use->id;
		$num=$request->input('num');
		$ar=DB::insert("insert into cart(`u_id`,`gid`,`num`,`goods_name`,`attr_name`)value('$uid','$gid','$num','$goods_name','$attr_name')");
	}
	 public function cate()
	{
		$use=auth()->user();
		$uid=$use->id;
		$arr=DB::select("select cart.id,cart.num,cart.goods_name,cart.attr_name,goodsatt.price,goodsatt.sn_number from cart join goodsatt on cart.gid=goodsatt.id  where cart.u_id='$uid'");
		return response()->json($arr);
	}
	public function updatcate(Request $request)
	{
		$id=$request->input('id');
		$num=$request->input('num');
		$arr=DB::update("update cart set num='$num' where id ='$id'");
	}
	public function add(Request $request)
	{
		$pid=$request->input('pid');
		$ar=DB::select("select * from area where area_type='1'");
		return response()->json($ar);
	}
	public function address(Request $request)
	{
		$pid=$request->input('pid');
		$ar=DB::select("select * from area where parent_id='$pid'");
		return response()->json($ar);
	}
	public function ress(Request $request)
	{
		DB::update("update useraddress set defau='no'where defau='ok' ");
		$use=auth()->user();
		$uid=$use->id;
		$address=$request->input('address');
		$ar=DB::insert("insert into useraddress(`user_id`,`user_address`,`defau`)value('$uid','$address','ok')");
	}
}