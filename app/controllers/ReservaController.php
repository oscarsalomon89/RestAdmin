<?php
 class ReservaController extends BaseController {
    
    public function index(){
   		$reservas = Reserva::all(array('id','date','name','cantpersons'));
   		$reserva = new Reserva();
        return View::make('reservas.index', array('reservas' => $reservas, 'reserva'=>$reserva));
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

    public function save() {
   $reserva = new Reserva();
   $reserva->date = Input::get('date');
   $reserva->name = Input::get('name');
   $reserva->cantpersons = Input::get('cantpersons');

   $validator = Reserva::validate(Input::all());
      if ($validator->fails())
      {
      $errors = $validator->messages()->all();
      return View::make('reservas.save')->with('reserva', $reserva)->with('errors', $errors);
      }else{
          $reserva->save();
         return Redirect::to('reservas')->with('notice', 'La Reserva ha sido creada correctamente.');
      }     
}
    public function edit($id) {
    $reserva = Reserva::find($id);
   return View::make('reservas.save')->with('reserva', $reserva);
     }
   public function update($id) { 
   $reserva = Reserva::find($id);
   $reserva->date = Input::get('date');
   $reserva->name = Input::get('name');
   $reserva->cantpersons = Input::get('cantpersons');
   $validator = Reserva::validate(Input::all(), $reserva->id);

   if($validator->fails()){
      $errors = $validator->messages()->all();
      return View::make('reservas.save')->with('reserva', $reserva)->with('errors', $errors);
   }else{
      $reserva->save();
      return Redirect::to('reservas')->with('notice', 'La reserva ha sido modificado correctamente.');
   }
   }
 public function destroy($id) { 
   $reserva = Reserva::find($id);
   $reserva->delete();
   return Redirect::to('reservas')->with('notice', 'La Reserva ha sido eliminada correctamente.');
   }
}