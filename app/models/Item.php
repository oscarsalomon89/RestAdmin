<?php
class Item extends Eloquent {

  protected $fillable = array('descripcion', 'price', 'category_id');

	 public function category(){
      return $this->belongsTo('Category');
   }
    public function orders()
    {
        return $this->belongsToMany('Order');
    }


   //VALIDACIONES
    public static $rules = array(
      'name' => 'required|min:4',
      'description' => 'required|min:10',
      'price'=>'required',
      'category_id'=>'required|numeric',
   );

   public static function validate($data, $id=null){
      $reglas = self::$rules;
      return Validator::make($data, $reglas);
   }

}