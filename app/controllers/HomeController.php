<?php

class HomeController extends BaseController {

 private $autorizado;
   public function __construct() {
      $this->autorizado = (Auth::check() and Auth::user()->name == 'Ariel');
   } 

   	public function index()
	{
    $consulta = new Consulta();
		return View::make('web.index', array('consulta' => $consulta));
	}
      public function store()
  {
      $consulta = new Consulta();
      $consulta->email = Input::get('email');
      $consulta->consulta = Input::get('consulta');
      
      $validator = Consulta::validate(Input::all());
   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $consulta->save();
          return Response::json(array(
            'success'     =>  true
        ));
   }
  }
	public function indexAdmin() {
	if(!$this->autorizado) return Redirect::to('/index.php/auth/login');
    $users = User::all(array('id', 'name', 'lastname' ));
    $orders = Order::all()->count();
    return View::make('inicio',array('users'=> $users, 'orders'=>$orders));
   }

}
