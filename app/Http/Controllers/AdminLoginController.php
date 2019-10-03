<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;

class AdminLoginController extends Controller
{
    public function get_login(){        
    	return view ('page.login');
    }

    public function postLogin(Request $request)
    {
    	$condition=false;
    	$user=DB::table('db_tsb_support.ms_user')
    			->where('username',$request->get('username'))
    			->first();
    	if($user != null){
    		if($user->username == $request->get('username') && $user->password== $request->get('password')){
    			$condition = true;
    		}
    	}
    	 if ($condition) {
            Session::put('is_login', true);
            Session::put('id',$user->id_user);         
            Session::put('name',$user->nama);
            Session::put('role',$user->role);
            return [
                "status" => "success",
                "redirect_route" => "dashboard" 
            ];
        }

        return [
            "status" => "error",
            "message" => "User is not valid"
        ];
    }

    public function logout(){
      Auth::logout();
      Session::flush();
      return redirect('login')->with('status','Logout Successfully');
   }
}
