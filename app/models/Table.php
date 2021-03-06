<?php
class Table extends Eloquent{

public function orders(){
   return $this->hasMany('Order');
}


//VALIDACIONES
    public static $rules = array(
      'number' => 'required|numeric',
      'seats' => 'required|numeric'
   );


public static $messages = array(
      'number.required' => 'El numero es obligatorio.',
      'number.numeric' => 'El debe ser un numerico.',
      'number.unique' => 'El numero pertenece a otra mesa.',
      'seats.required' => 'La cantidad es obligatorio.',
      'seats.numeric' => 'La cantidad debe se un numero.',     
   );

   public static function validate($data, $id=null){
      $rules = self::$rules;
      $messages = self::$messages;
      return Validator::make($data, $rules, $messages);
   }
}
?>