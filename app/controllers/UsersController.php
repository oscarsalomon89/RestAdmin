<?php
 class UsersController extends BaseController {
    
   public function index() {
   $users = User::all(array('name','lastname'));
   return View::make('users.index')->with('users', $users);
   }

   public function show($id) { 
   $user = User::find($id);
   return View::make('users.show')->with('user', $user);
   }

   public function create() { 
   	$user = new User();
   return View::make('users.save')->with('user', $user);
   }

   public function store() { 
   $user = new User();
   $user->name = Input::get('name');
   $user->lastname = Input::get('lastname');
   $user->password = Hash::make(Input::get('password'));
   $validator = User::validate(array(
      'name' => Input::get('name'),
      'lastname' => Input::get('lastname'),
      'password' => Input::get('password'),
   ));
   if($validator->fails()){
      $errors = $validator->messages()->all();
      $user->password = null;
      return View::make('users.save')->with('user', $user)->with('errors', $errors);
   }else{
      $user->save();
      return Redirect::to('users')->with('notice', 'El usuario ha sido creado correctamente.');
   }
   }

   public function edit($id) { 
   	$user = User::find($id);
   return View::make('users.save')->with('user', $user);
   }

   public function update($id) { 
   $user = User::find($id);
   $user->name = Input::get('name');
   $user->lastname = Input::get('lastname');
   $validator = User::validate(array(
      'name' => Input::get('name'),
      'lastname' => Input::get('lastname'),
      'password' => $user->password, 
   ), $user->id);
   if($validator->fails()){
      $errors = $validator->messages()->all();
      $user->password = null;
      return View::make('users.save')->with('user', $user)->with('errors', $errors);
   }else{
      $user->save();
      return Redirect::to('users')->with('notice', 'El usuario ha sido modificado correctamente.');
   }
   }

   public function destroy($id) { 
   	$user = User::find($id);
   $user->delete();
   return Redirect::to('users')->with('notice', 'El usuario ha sido eliminado correctamente.');
   }
 }
?>