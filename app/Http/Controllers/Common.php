<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class Common extends Controller
{
	public function __construct(Request $request){
        $name= $request->session()->get('name');
			if (empty($name)) {
	    		return redirect()->action('Login@show');
	    	}
	    }
}
 ?>