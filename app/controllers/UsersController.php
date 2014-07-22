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
     $message = $this->user->createOrUpdate($id, Input::all());
     return Response::json($message);
    }

   public function create() { 
   $user = new User();
   return View::make('users.save')->with('user', $user);
   }

   public function store() { 
   $user = new User();

   $validator = User::validate(Input::all());
   if($validator->fails()){
   return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
   $user->name = Input::get('name');
   $user->lastname = Input::get('lastname');
   $user->password = Hash::make(Input::get('password'));
      $user->save();
          return Response::json(array(
            'success'     =>  true
        ));
   }
   }

   public function edit($id) { 
   $user = $this->user->getUserById($id);
   return View::make('users.save')->with('user', $user);
   }

   public function update($id) { 
   $message = $this->user->createOrUpdate($id, Input::all());
   return Response::json($message);
   }

   public function destroy($id) { 
   	$user = User::find($id);
   $user->delete();
   return Redirect::to('users')->with('notice', 'El usuario ha sido eliminado correctamente.');
   }
 }
?>