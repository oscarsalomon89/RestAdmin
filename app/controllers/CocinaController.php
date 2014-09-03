<?php
 class CocinaController extends BaseController {

public function index(){
	return View::make('cocina.index');
		}

public function items(){
	$orders = Order::all();
	$quantOrders = DB::table('orders')->count();
	$quantItems = DB::table('item_order')->count();
	return View::make('cocina.orders', array('orders' => $orders, 'quantOrders' => $quantOrders, 'quantItems' => $quantItems));
		}

public function itemsOrders($cant, $items){
	$quantOrders = DB::table('orders')->count();
	$quantItems = DB::table('item_order')->count();
	if ($quantOrders != $cant) {
		return Response::json(array(
			'success' => true
		));
	}
		return Response::json(array(
			'success' => false
		));
		}
	}
?>