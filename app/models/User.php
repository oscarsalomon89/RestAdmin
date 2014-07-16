<?php
use Illuminate\Auth\UserInterface;
class User extends Eloquent implements UserInterface{

   protected $fillable = array('name', 'lastname', 'password');
   
   public function role(){
      return $this->belongsTo('Role');
   }
	public function orders(){
   return $this->hasMany('Order');
}
   public static $rules = array(
      'name' => 'required|min:2',
      'lastname' => 'required|unique:users',
      'password' => 'required',
   );

   public static $messages = array(
      'name.required' => 'El nombre es obligatorio.',
      'name.min' => 'El nombre debe contener al menos dos caracteres.',
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
