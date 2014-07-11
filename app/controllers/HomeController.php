<?php

class HomeController extends BaseController {

 private $autorizado;
   public function __construct() {
      $this->autorizado = (Auth::check() and Auth::user()->name == 'Ariel');
   } 

   	public function index()
	{
		return View::make('web.index');
	}
	public function indexAdmin() {
	if(!$this->autorizado) return Redirect::to('/index.php/auth/login');
    $users = User::all(array('id', 'name', 'lastname' ));
    $orders = Order::all()->count();
    return View::make('inicio',array('users'=> $users, 'orders'=>$orders));
   }

}
