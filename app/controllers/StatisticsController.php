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

 	$items = DB::table('orders')
	->select('date', DB::raw('SUM(total) AS total'))
 	->groupBy('created_at')
 	->get();
 	return Response::json($items);
 }

}