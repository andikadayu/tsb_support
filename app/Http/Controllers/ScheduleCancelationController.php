<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ScheduleCancelationController extends Controller
{
    public function schedule_cancel(Request $request)
    {
    \Carbon\Carbon::setLocale('id');
    $tgll=\Carbon\Carbon::now()->format('Y:m:d H:i:s');
    	$rec=$request->input('receipt');
    	$take=DB::table('db_time_slot.tb_delivery_detail')
    			->where('receipt',$rec)
    			->get();
    	foreach ($take as $a) {
    		$schedule=$a->id_schedule_group;
    	}

    	$query1=DB::table('db_tsb_support.tb_schedule_cancel')
    			->insert([
    				'reason'		=>	$request->input('reason'),
    				'request_by'	=>	$request->input('req_by'),
    				'reason_time'	=>	$tgll,
    				'receipt_number'=>	$rec,
    				'cancel_by'		=>	$request->input('cancel_by'),
    				'created_at'	=>	$tgll,
    				'created_by'	=>	$request->input('cancel_by')
    			]);
    	$query2=DB::table('db_time_slot.tb_delivery_detail')
    			->where('receipt','like',$rec)
    			->delete();
    	$query3=DB::table('db_time_slot.tb_delivery_coa')
    			->where('id_schedule','like',$schedule)
    			->delete();
        // $query31=DB::table('db_time_slot.tb_delivery_coa')
        //         ->where('id_schedule','like',$schedule)
        //         ->delete();
    	$query4=DB::table('db_time_slot.tb_delivery_invoice')
    			->where('id_schedule','like',$schedule)
    			->delete();
    	$query5=DB::table('db_time_slot.tb_schedule_detail')
    			->where('schedule_number','like',$schedule)
    			->update([
    				'status'	=>	"0"
    			]);
    	$query6=DB::table('db_time_slot.tb_scheduler')
    			->where('id_schedule','like',$schedule)
    			->update([
    				'status'	=>	"0"
    			]);
        
    	if($query1){
    		return "sukses";
    	}else{
    		return "error";
    	}
    }
}
