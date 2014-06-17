<?php
class AuthController extends BaseController {
   public function getLogin() {
      return View::make('auth.login');
   }
   public function postLogin() {
      $user_data = array(
         'name' => Input::get('name'),
         'password' => Input::get('password')
      );
      if(Auth::attempt($user_data)){
         return Redirect::to('auth/welcome');
      }else{
         return $this->getLogin()->with('error', 'Usuario o contraseña incorrectos.');
      }
   } 
   public function getWelcome(){
      if(Auth::check()){
         $user = Auth::user();
         $users = User::all(array('id', 'name', 'lastname' ));
         $orders = Order::all()->count();
         return View::make('inicio', array('user' => $user, 'users'=> $users, 'orders'=>$orders));
      }else{
         return $this->getLogin();
      }
   }
   public function getLogout(){
      if(Auth::check()){
         Auth::logout();
      }
      return Redirect::to('auth/login');
   }
}
?>