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
        return $this->belongsToMany('Item')->withPivot('quantity','price');
    }

    //VALIDACIONES
    public static $rules = array(
      'date' => 'required|date',
      'user_id' => 'required',
      'table_id'=>'required',
      'status'=>'required|numeric'
   );

   public static function validate($data, $id=null){
      $reglas = self::$rules;
      return Validator::make($data, $reglas);
   }
}