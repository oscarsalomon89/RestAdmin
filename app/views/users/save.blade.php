@extends('layouts.master')

@section('content')
@if(isset($errors))
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
<h1> Usuario </h1>
    {{ Form::open(array('url' => 'users/' . $user->id)) }}
    <div class="form-group">
       {{ Form::label ('name', 'Nombre real') }}
       {{ Form::text ('name', $user->name, array('class'=>'form-control','placeholder'=>'nombre', 'autocomplete'=>'of')) }}
    </div>
    <div class="form-group">
       {{ Form::label ('lastname', 'Apellido') }}
       {{ Form::text ('lastname', $user->lastname, array('class'=>'form-control','placeholder'=>'Apellido', 'autocomplete'=>'of')) }} 
     </div> 
       @if($user->id)
          {{ Form::hidden ('_method', 'PUT') }}
       @else
       <div class="form-group">
          {{ Form::label ('password', 'Contraseña') }}
          {{ Form::password ('password',array('class'=>'form-control','placeholder'=>'password', 'autocomplete'=>'of')) }}
      </div>
       @endif
       {{ Form::submit('Guardar usuario',array('class'=>'btn btn-success')) }}
       {{ link_to('users', 'Cancelar') }}
    {{ Form::close() }}
</div>
</div>
</div>
</div>
<div class="col-md-4">
{{ HTML::image('images/user.png', "Imagen no encontrada", array('id' => 'user')) }}
</div>
</div>
@stop