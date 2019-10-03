<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class POController extends Controller
{
	public function view()
	{
		$data = DB::table('sap_temp_db.tb_po_subpo as sup_po')
		->leftJoin('db_time_slot.tb_rds_detail as rds', 'rds.po_number', '=', 'sup_po.po_number')
		->where('sup_po.po_number', '4516424309')
		->where('sup_po.order_qty', '!=', 'sup_po.qty_acc')
		->get();

		return view('page.po', compact('data'));
	}

	public function get_receipt()
	{
		$id = request()->get('rcp');
		$data = DB::table('db_time_slot.tb_rds_detail')
		->select('tb_rds_detail.id', 'tb_rds_detail.po_number', 'po_line_item', 'tb_rds_detail.material_code', 'tb_rds_detail.qty', 'tb_rds_detail.sap_line', 'tb_rds_detail.sap_sloc', 'tb_rds_detail.sap_stock_type', 'tb_rds_detail.sap_uom', 'tb_rds_detail.requested_delivery_date', 'ms_material.material_name')
		->join('db_time_slot.tb_scheduler', 'tb_scheduler.id_schedule', '=', 'tb_rds_detail.id')
		->join('db_time_slot.tb_delivery_detail', 'tb_scheduler.schedule_number', '=', 'tb_delivery_detail.id_schedule_group')
		->join('skin_master.ms_material', 'ms_material.material_sku', '=', 'tb_rds_detail.material_code')
		->where('tb_delivery_detail.receipt', $id)
		->get();

		echo "
		<form method='post' id='save_dt'>
		<table id='datatables' class='table table-striped table-bordered table-hover' cellspacing='0' width='100%' style='width:100%'>
		<thead>
		<tr>
		<th hidden=''></th>
		<th> <b class='font-weight-bold'> PO Number </b> </th>
		<th> <b class='font-weight-bold'> PO Line / Item Number </b> </th>
		<th> <b class='font-weight-bold'> Material Code </b> </th>
		<th> <b class='font-weight-bold'> Material Name </b> </th>
		<th> <b class='font-weight-bold'> Qty / Order Qty </b>  </th>
		</tr>
		</thead>  
		<tbody>
		";

		foreach($data as $p){
			$asw = strval($p->qty);
			echo "
			<tr>
			<td hidden=''>$p->id</td>
			<td><input type='text' name='po_number[]' class='form-control-plaintext' readonly='' value='$p->po_number'></td>
			<td><input type='number' value='$p->sap_line' class='form-control' id='sap' name='sap[]'></input></td>
			<td>$p->material_code</td>
			<td>$p->material_name</td>
			<td><input type='text' name='qty[]' class='form-control-plaintext' readonly='' value='$asw'></td>
			</tr>
			";
		}

		echo "</tbody>
		</table></form>";
	}

	public function edit_sap(Request $request)
	{
		$po_number=$request->input('po_number');
		$jumlah=count($po_number)-1;
		do{
			$p=$request->input('sap')[$jumlah];$j=$po_number[$jumlah];$q=$request->input('qty')[$jumlah];

			$update=DB::table('db_time_slot.tb_rds_detail')
			->where('po_number',$j)
			->update([
				'sap_line'	=>	$p
			]);

			$po=DB::table('sap_temp_db.tb_po_subpo')
			->where('po_number',$j)
			->where('item_number','<',$p)
			->get();
			$jpo=count($po)-1;
			do{
				$pol=$po[$jpo]->order_qty;
				$poll=$po[$jpo]->item_number;
				$polll=$po[$jpo]->po_number;
				$sub=DB::table('sap_temp_db.tb_po_subpo')
					->where('po_number',$polll)
					->where('item_number',$poll)
					->update([
						'qty_acc' => $pol
					]);
				$jpo--;
			}while($jpo > -1);	

			$jm=DB::table('sap_temp_db.tb_po_subpo')
					->where('po_number',$j)
					->sum('order_qty');

			$qt=DB::table('sap_temp_db.tb_po_subpo')
			->where('po_number',$j)
			->where('item_number',$p)
			->get();
			foreach ($qt as $as) {
				$qol=$as->qty_acc + $jm;
				$qoll=$as->item_number;
				$qolll=$as->po_number;
				$q_acc=DB::table('sap_temp_db.tb_po_subpo')
				->where('po_number',$qolll)
				->where('item_number',$qoll)
				->update([
					'qty_acc' => $qol
				]);

			}
			$jumlah--;

		}while($jumlah > -1);

		// dd($update,$sub,$q_acc);
		if($update){
			return "sukses";
		}else{
			return "error";
		}
	}

}

