@extends('layouts.master')

@section('content')
@if(Session::has('notice'))
    <div class="alert alert-success" id='del'>{{ Session::get('notice') }}</div>
    @endif
<h1> Reservas </h1>
<p> {{ link_to ('reservas/create', 'Crear nueva Reserva') }} </p>
<div class='errors_form'></div>
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
                <td> {{ $reserva->cantpersons }} </td>
                <td> <a href = 'reservas/{{$reserva->id}}/edit' class="btn btn-default btn-xs">Editar</a> </td>
                <td> {{ Form::open(array('url' => 'reservas', 'id' => 'formulario_delete')) }}
        <input type="hidden" id= 'reserva_id' name="reserva_id" value='{{$reserva->id}}'>
        {{ Form::submit('Eliminar', array('class' => 'btn btn-primary btn-xs')) }}       
        {{ Form::close() }} </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>
@stop
