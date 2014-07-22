<?php namespace repositories\User;
use \User;

class UserRepository implements IUserRepository {

public function getAllUsers()
    {
        return User::all();
    }
 
    public function getUserById($id)
    {
        return User::find($id);
    }
 
    public function createOrUpdate($id = null, $input)
    {
    if(is_null($id)) {
      $validator = User::validate($input);
      if ($validator->fails()){
      
      return array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      );
        }
    else{
      User::create($input);  
          return array(
            'success'     =>  true
        );
   }
 }
 else{
  $user = User::find($id);
  $validator = User::validate($input);
  if ($validator->fails()){      
      return array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      );
        }
    else{
      $user->name = Input::get('name');
      $user->lastname = Input::get('lastname');
      $user->save(); 
          return array(
            'success'     =>  true,
            'types' => 'edit'
        );
   }
 }
}
}
