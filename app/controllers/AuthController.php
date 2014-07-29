<?php
class AuthController extends BaseController {

 public function showLogin()
    {
        // Verificamos que el usuario no esté autenticado
        if (Auth::check())
        {
            // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
            return Redirect::to('/admin');
        }
        // Mostramos la vista login.blade.php (Recordemos que .blade.php se omite.)
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

   public function Logout(){
      if(Auth::check()){
         Auth::logout();
      }
      return Redirect::to('login');
   }
}
?>