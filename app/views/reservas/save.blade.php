@extends('layouts.master')

@section('content')
@if(isset($errors))
<br>
   <ul>
      @foreach($errors as $item)
         <li> {{ $item }} </li>
      @endforeach
   </ul>
@endif
<div class="row">
<div class="col-md-8">
  <div class="widget">
     <div class="widget-content-white glossed">
     <div class="padded">
<h1>Nueva Reserva</h1>
<!--en este los errores del formulario--> 
<div class='errors_form'></div>
{{ Form::open(array('url' => 'reservas/'.$reserva->id, 'id' => 'form')) }}
    <div class="form-group">
       {{ Form::label ('date', 'Fecha') }}
       <input type="date" name='date' class='form-control'>
    </div>
    <div class="form-group">
       {{ Form::label ('name', 'Nombre') }}
       {{ Form::text ('name', $reserva->name, array('class'=>'form-control','placeholder'=>'Nombre', 'autocomplete'=>'of')) }} 
     </div> 
       <div class="form-group">
       {{ Form::label ('cantpersons', 'Cantidad de personas') }}
       {{ Form::text ('cantpersons', $reserva->cantpersons, array('class'=>'form-control','placeholder'=>'Cantidad de personas', 'autocomplete'=>'of')) }} 
     </div>
      <br>
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" class="btn btn-success">
{{ Form::close() }}
</div>
</div>
</div>
</div>
<div class="col-md-4">
  <br>
{{ HTML::image('images/calendar.png', "Imagen no encontrada", array('id' => 'calendar')) }}
</div>
</div>
@stop