<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DTChangeController extends Controller
{
    public function tampil_dt(Request $request)
    {
    	$ven=$request->get('ven');
    	$rec=$request->get('rec');
    	$data=DB::table('db_time_slot.tb_delivery_detail as det')
    			->where('det.receipt',$rec)
    			->get();
    	foreach ($data as $k) {
    		$dr=$k->id_driver; $tr=$k->id_truck;
    	}

    	$truck=DB::table('db_time_slot.ms_truck as trc')
    			->where('trc.vendor_code',$ven)
    			->get();
    	$driver=DB::table('db_time_slot.ms_driver as dri')
    			->where('dri.vendor_code',$ven)
    			->get();
    			echo "
    			<div class='form-group bmd-form-group'>
    				<div class='input-group'>
    					<div class='input-group-prepend'>
    						<div class='input-group-text'>
    							<i class='material-icons'>airport_shuttle</i> Truck </div>
    						</div>
    					<select name='truk' id='truk' class='selectpicker' data-style='btn btn-info' title='Truck'>
    			";
    	foreach ($truck as $trk) {
    		if($trk->id == $tr){
    			$selected = "selected";
    		}else{
    			$selected ="";
    		}
    		echo "<option value='$trk->id' ".$selected." >$trk->police_number</option>";
    	}
    	echo "</select>
    	</div>
    	</div>
    	</div>
    	<div class='form-group bmd-form-group'>
    			<div class='input-group'>
    			<div class='input-group-prepend'>
    			<div class='input-group-text'><i class='material-icons'>airline_seat_recline_normal</i> Driver </div>
    			</div>
    			<select name='driver' id='driver' class='selectpicker' data-style='btn btn-info' title='Driver'
    	";
    	foreach ($driver as $drv) {
    		if($drv->id == $dr){
    			$selected = "selected";
    		}else{
    			$selected="";
    		}
    		echo "<option value='$drv->id' ".$selected." >$drv->driver_name</option>";
    	}
    	echo "</select></div></div></div>";
    }

    public function update_drvtrk(Request $request)
    {
    	$id=$request->input('receipt');
    	$drv=DB::table('db_time_slot.ms_driver')
    		->where('id',$request->driver)
    		->get();
    	foreach ($drv as $ks) {
    		$driver_name=$ks->driver_name;$driver_id=$ks->id;
    	}
    	$update=DB::table('db_time_slot.tb_delivery_detail')
    			->where('receipt',$id)
    			->update([
    				'id_truck'		=>	$request->input('truk'),
    				'id_driver'		=>	$driver_id,
    				'driver_name'	=>	$driver_name
    			]);
    	if($update){
    		return "sukses";
    	}else{
    		return "error";
    	}

    }
}
