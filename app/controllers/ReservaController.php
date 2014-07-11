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
      $title = 'Nueva';
      return View::make('reservas.save', array('reservas' => $reservas, 'reserva'=>$reserva, 'title'=>$title));
     }

    public function store() {
   $reserva = new Reserva();
   $reserva->date = Input::get('date');
   $reserva->name = Input::get('name');
   $reserva->cantpersons = Input::get('cantpersons');

   $validator = Reserva::validate(Input::all());
      if ($validator->fails())
      {
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
      }else{
          $reserva->save();
          return Response::json(array(
            'success'     =>  true
        ));
      }     
}
    public function edit($id) {
    $reserva = Reserva::find($id);
    $title = 'Editar';
   return View::make('reservas.save', array('reserva'=>$reserva, 'title'=>$title));
     }
   public function update($id) { 
   $reserva = Reserva::find($id);
   $reserva->date = Input::get('date');
   $reserva->name = Input::get('name');
   $reserva->cantpersons = Input::get('cantpersons');
   $validator = Reserva::validate(Input::all(), $reserva->id);

   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $reserva->save();
          return Response::json(array(
            'success'     =>  true,
            'types' => 'edit'
        ));
   }
   }
 public function destroy() { 
   $reserva = Reserva::find(Input::get('reserva_id'));
   $reserva->delete();
 return Response::json(array(
          'success' => true,
          'message' => 'Se elimino correctamente'
      ));
   }
}