<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface{


	public function orders(){
   return $this->hasMany('Order');
}
   public static $rules = array(
      'firstname' => 'required|min:2',
      'username' => 'required|min:2|unique:users',
      'lastname' => 'required',
      'password' => 'required',
   );

   public static $messages = array(
      'firstname.required' => 'El nombre es obligatorio.',
      'firstname.min' => 'El nombre debe contener al menos dos caracteres.',
      'username.required' => 'El nick es obligatorio.',
      'username.min' => 'El nick debe contener al menos dos caracteres.',
      'lastname.required' => 'El apellido es obligatorio.',
      'password.required' => 'El password es obligatorio.',
   );

   public static function validate($data, $id=null){
      $rules = self::$rules;
      $messages = self::$messages;
      return Validator::make($data, $rules, $messages);
   }

public function getAuthIdentifier(){
   return $this->getKey();
} 
public function getReminderName(){
   return $this->name;
} 
public function getAuthPassword(){
   return $this->password;
}
public function getRememberToken()
{
    return $this->remember_token;
}

public function setRememberToken($value)
{
    $this->remember_token = $value;
}

public function getRememberTokenName()
{
    return 'remember_token';
}
}
