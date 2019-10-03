<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class masterUserController extends Controller
{
	public function view()
	{
		$data=DB::table('db_tsb_support.ms_user as user')
			->join('db_time_slot.ms_role as role','role.id','=','user.role')
			->get();
		return view('page.master_user',['show'=>$data]);
	}
	public function add_user(Request $request){    	
		$insert=DB::table('db_tsb_support.ms_user')
			->insert([
				'nama' 		=> $request->input('nama') ,
				'username' 	=> $request->input('username'),
				'password'	=> $request->input('password'),
				'role'	=>	1,
				'created_at'	=> date('Y-m-d H:i:s')
		]);	
		if ($insert) {
			return "sukses";
		}else {
			return "error";
		}

	}

	public function get_edit(Request $request)
	{
		$id = $request->get('id_user');   	
		$get_edit = DB::table('db_tsb_support.ms_user')
		->where('id_user',$id)
		->get();
		return $get_edit;
	}

	public function update_user(Request $request)
	{
		$update = DB::table('db_tsb_support.ms_user')
		->where('id_user',$request->input('edit_id'))
		->update([
			'nama' 			=>$request->input('edit_nama') ,
			'username' 		=>$request->input('edit_username'),
			'password'		=>$request->input('edit_password'),
			'updated_at'	=>date('Y-m-d H:i:s')
		]);
		if ($update) {
			return "sukses";
		}else {
			return "error";
		}
	}

	public function delete_user(Request $request)
	{
		$id = request()->get('id_user');
		$delete = DB::table('db_tsb_support.ms_user') 
		->where('id_user',$id)
		->delete();
		if ($delete < 0) {
			return "gagal";
		}else{
			return "sukses";
		}
	}
}