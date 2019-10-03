<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ListScheduleController extends Controller
{
    public function view()
    {
    	return view('page.list_schedule');

    }
    public function tampil_list(Request $request)
    {
    	$no=1;
   		$tgl=$request->get('cari');
   		$data=DB::table('db_time_slot.tb_schedule_detail as a')
   				->join('db_time_slot.ms_time_slot as b','a.id_time_slot','=','b.id')
   				->leftJoin('skin_master.ms_supplier as c','c.vendor_code','=','a.vendor_code')
   				->leftJoin('db_time_slot.tb_delivery_detail as d','d.id_schedule_group','=','a.schedule_number')
          ->where('d.receipt','not like','')
   				->where('a.rdd',$tgl)
   				->get();
   				echo "
   				<table id='datatables' class='table table-striped table-bordered table-hover' cellspacing='0' width='100%' style='width:100%''>
   				<thead>
	   				<tr>
		   				<th>No. </th>
		   				<th>Reception Number</th>
		   				<th>Vendor Code ~ Alias</th>
		   				<th>RDD</th>
		   				<th>Time Slot</th>
		   				<th>Action</th>
		   			</tr>
   				</thead>
   				<tbody>";
   		foreach ($data as $k) {
   			$rece="$k->receipt";
   			$gt="get_tamp('".$rece."')";
   			$ven="$k->vendor_code";
   			$ge="get_ven('".$ven."','".$rece."')";
   			echo "
   			<tr>
	   			<td>".$no++."</td>
	   			<td>$k->receipt</td>
	   			<td>$k->vendor_code ~ $k->vendor_alias</td>
	   			<td>$k->rdd</td>
	   			<td>$k->shift</td>
	   			<td class='td-actions text-right'>
	   			";
	   		if($k->status == "1"){
	   			echo "<button class='btn btn-danger btn-float btn-sm w-auto fa fa-people' data-toggle='modal' data-target='#addReason' title='Cancel Schedule' onclick=".$gt.">
		   			<i class='fa fa-truck' aria-hidden='true'></i>
		   			</button>";
	   		}
	   			echo"
		   			<button type='button' rel='tooltip' class='btn btn-danger btn-round'  data-original-title='Change Driver & Truck' title='Change Driver & Truck' data-target='#upd_driv' data-toggle='modal' onclick=".$ge.">
		   			<i class='fa fa-wheelchair' aria-hidden='true'></i>
		   			</button>
	   			</td>
   			</tr>				
   			";
   		}
   		echo "</tbody
   		</table>";
    }
}
