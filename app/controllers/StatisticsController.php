<?php
 class StatisticsController extends BaseController {

public function index() {
   $items = DB::table('item_order')
   ->join('items', 'item_order.item_id', '=', 'items.id')
   ->select('items.name', DB::raw('SUM(quantity) AS quantity'))->groupBy('item_id')
   ->orderBy('quantity', 'desc')->get();
   return Response::json($items);
   }

}