<?php
class Order extends Eloquent{
   
 public function user(){
      return $this->belongsTo('User');
   }
 public function table(){
      return $this->belongsTo('Table');
   }

public function items()
    {
        return $this->belongsToMany('Item')->withPivot('quantity','price','id');
    }

    //VALIDACIONES
    public static $rules = array(
      'user_id' => 'required',
      'table_id'=>'required'
   );
    public static $messages = array(
          'user_id.required'=> 'Ingresar un mozo es obligatorio.',
          'table_id.required' => 'Debe ingresar una una mesa'
      );

   public static function validate($data, $id=null){
      $rules = self::$rules;
      $messages = self::$messages;
      return Validator::make($data, $rules, $messages);
   }
}