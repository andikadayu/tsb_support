<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;


class UserProfileController extends Controller
{
    // use Notifiable;

    public function getData(Request $request)
    {
    	$id=$request->session()->get('id');
    	$data=DB::table('db_tsb_support.ms_user as user')
        ->join('db_time_slot.ms_role as role','user.role','=','role.id')
    	->where('id_user',$id)
    	->get();
    	return view('page.profile_user',[
    		'show'=>$data
    	]);
    }
    public function save_profile(Request $request)
    {
    	$insert=DB::table('db_tsb_support.ms_user')
    	->where('id_user',$request->input('id_hidden'))
    	->update([
    		'nama'=>$request->input('name'),
    		'username'=>$request->input('username'),
    		'password'=>$request->input('password'),
    		'updated_at'=>date('Y-m-d H:i:s')
    	]);
    	if ($insert) {
  
    		return "sukses";
    	}else {
    		return "error";
    	}
    }
   

}
