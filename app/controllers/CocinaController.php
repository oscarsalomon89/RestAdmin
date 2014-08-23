<?php
 class CocinaController extends BaseController {

public function index(){
	$orders =Order::all();
 	return View::make('cocina.index', array('orders' => $orders));
      }

 }
?>