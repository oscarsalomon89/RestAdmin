<?php
 class StatisticsController extends BaseController {

public function index() {
   $items = DB::table('item_order')->where('item_order.created_at', '>', '2014-07-31')
   ->join('items', 'item_order.item_id', '=', 'items.id')
   ->select('items.name', DB::raw('SUM(quantity) AS quantity'))->groupBy('item_id')
   ->orderBy('quantity', 'desc')->get();
   return Response::json($items);
   }

 public function barrasChart(){
/*
SELECT Month(o.created_at) as MES, sum(o.total) as TOTAL FROM restappdb.orders o
group by Month(o.created_at);

$items = DB::select('SELECT Month(created_at) as fecha, SUM(total) as total FROM orders
group by Month(created_at)');
*/

	$items = DB::table('orders')
	->select('created_at AS fecha', DB::raw('SUM(total) AS total'))
 	->groupBy('orders.created_at')
 	->get();
 	return Response::json($items);
 }

}