<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
	public function view()
	{
		return view('page.dashboard');
	}

	public function statistik()
	{
		$data['total_admin']=DB::table('db_tsb_support.ms_user')
			->count();
		$data['total_driver']=DB::table('db_time_slot.ms_driver')
			->count();
		$data['total_truck']=DB::table('db_time_slot.ms_truck')
			->count();
		return $data;
	}

	public function setting()
	{
		return view('Component.setting_web');
	}
}
