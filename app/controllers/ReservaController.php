<?php
 class ReservaController extends BaseController {
    
    public function index(){
   		$reservas = Reserva::all();
        return View::make('reservas.index')->with('reservas', $reservas);
    }
}