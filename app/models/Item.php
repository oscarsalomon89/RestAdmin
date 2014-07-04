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
      'category_id'=>'required',
   );
    public static $messages = array(
          'name.required'=> 'Ingresar un nombre es obligatorio.',
          'name.min'=> 'El nombre debe tener al menos dos caracteres.',
          'description.required'=> 'Ingresar la descripcion es obligatorio.',
          'description.min' => 'La descripcion no puede tener menos de diez caracteres.',
          'price.required' => 'Debe ingesar un precio',
          'category_id.required' => 'Debe ingresar una categoria'
      );

   public static function validate($data, $id=null){
      $reglas = self::$rules;
      $messages = self::$messages;
      return Validator::make($data, $reglas, $messages);
   }

}