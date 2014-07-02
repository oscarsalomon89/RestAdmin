<?php
 class ReservaController extends BaseController {
    
    public function index(){
   		$reservas = Reserva::all();
   		$reserva = new Reserva();
        return View::make('reservas.index2', array('reservas' => $reservas, 'reserva'=>$reserva));
    }
     public function lista() {
      $reservas = Reserva::all();
     return View::make('reservas.listres', array('reservas' => $reservas));
     }
    public function create() {
      $reservas = Reserva::all();
      $reserva = new Reserva();
      return View::make('reservas.save', array('reservas' => $reservas, 'reserva'=>$reserva));
     }

    public function guardar() {
      $rules = array(
          'date' => 'required|date',
          'name' => 'required|min:2',
          'cantpersons' => 'required|min:1'
      );
          
      $messages = array(
          'date.required'=> 'Ingresar una fecha es obligatorio.',
          'date.date'=> 'Ingresar una fecha.',
          'name.required'=> 'Ingresar el nombre es obligatorio.',
          'name.min' => 'El nombre no puede tener menos de dos caracteres.',
          'cantpersons.required' => 'Debe ingesar una cantidad',
          'cantpersons.min' => 'Debe ser al menos una persona'
      );
          
      $validation = Validator::make(Input::all(), $rules, $messages); 
      if ($validation->fails())
      {
        //como ha fallado el formulario, devolvemos los datos en formato json
      return Response::json(array(
          'success' => false,
          'errors' => $validation->getMessageBag()->toArray()
      )); 
          //en otro caso ingresamos al usuario en la tabla usuarios
      }else{
          $reserva = new Reserva();
          $reserva->date = Input::get('date');
          $reserva->name = Input::get('name');
          $reserva->cantpersons = Input::get('cantpersons');
          $reserva->save();
          return Response::json(array(
            'success'     =>  true,
            'message'     =>  'Se agrego la reserva correctamente'
            ));
      }     
}
    public function edit() {
      $reserva = new Reserva();
      return View::make('reservas.save', array('reserva'=>$reserva));
     }
}