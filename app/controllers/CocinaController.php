<?php
 class CocinaController extends BaseController {

public function index(){
	return View::make('cocina.index');
		}

public function items(){
	$orders =Order::all();
	$quantOrders = DB::table('orders')->count();
	return View::make('cocina.orders', array('orders' => $orders, 'quantOrders' => $quantOrders));
		}

public function itemsOrders($cant){
	$quantOrders = DB::table('orders')->count();
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