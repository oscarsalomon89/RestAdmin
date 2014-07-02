@extends('layouts.master')

@section('content')
@if(Session::has('notice'))
       <div class="alert alert-success">{{ Session::get('notice') }}</div>
    @endif
<p> {{ link_to ('reservas/create', 'Crear nueva Reserva') }} </p>
<h1> Reservas </h1>
<div class="widget-content-white glossed">
    <div class="padded">
          <table class="table table-striped table-bordered table-hover datatable">
          <thead>
          <tr>
             <th> Fecha </th>
             <th> Nombre </th>
             <th> Cantidad de personas </th>
          </tr>
          </thead>
          <tbody>
          @foreach($reservas as $reserva)
             <tr>
                <td> {{ $reserva->date }} </td>
                <td> {{ $reserva->name }} </td>
                <td> {{ $reserva->cantPersons }} </td>
                <td> <button id="edit-reserva" class="btn btn-default btn-xs">Editar</button> </td>
                <td> {{ link_to('reservas/'.$reserva->id.'/delete', 'Eliminar') }} </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>

@stop
