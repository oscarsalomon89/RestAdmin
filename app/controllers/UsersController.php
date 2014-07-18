<?php
use repositories\User\IUserRepository;
 class UsersController extends BaseController {
   
   public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    } 

   public function index() {
   $users = $this->user->getAllUsers();
   return View::make('users.index')->with('users', $users);
   }

   public function show($id) { 
   $user = $this->user->getUserById($id);
   return View::make('users.show')->with('user', $user);
   }

    public function saveUser($id = null)
    {
        if($id) {
            $this->user->createOrUpdate($id);
        }
        else {
            $this->user->createOrUpdate();
        }
        // return redirect...
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

   $validator = User::validate(Input::all());
   if($validator->fails()){
   return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $category->save();
          return Response::json(array(
            'success'     =>  true
        ));
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