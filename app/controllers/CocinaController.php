<?php
 class CocinaController extends BaseController {

public function index(){
	$orders =Order::where('status',true)->get();
 	return View::make('cocina.index', array('orders' => $orders));
      }

 }
?>