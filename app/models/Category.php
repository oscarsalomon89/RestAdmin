<?php
class Category extends Eloquent {

	protected $table = 'categories';

public function items(){
   return $this->hasMany('Item');
}
//VALIDACIONES
    public static $rules = array(
      'name' => 'required|min:2',
      'description' => 'required|min:10',
   );


public static $messages = array(
      'name.required' => 'El nombre es obligatorio.',
      'name.min' => 'El nombre debe contener al menos dos caracteres.',
      'description.required' => 'La descripcion es obligatoria.',
      'descripcion.min' => 'La descripcion debe contener al menos 10 caracteres.',
   );

   public static function validate($data, $id=null){
      $reglas = self::$rules;
      $messages = self::$messages;
      return Validator::make($data, $reglas, $messages);
   }

}