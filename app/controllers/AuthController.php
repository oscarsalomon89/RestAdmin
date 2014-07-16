<?php
class AuthController extends BaseController {
   public function getLogin() {
      return View::make('auth.login');
   }
   public function postLogin() {
      $user_data = array(
         'name' => Input::get('name'),
         'password' => Input::get('password'),
         'role_id' => '1'
      );
      if(Auth::attempt($user_data)){
            return Response::json(array(
            'success'     =>  true,
        ));
      }else{
            return Response::json(array(
            'success'     =>  false,
        ));
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