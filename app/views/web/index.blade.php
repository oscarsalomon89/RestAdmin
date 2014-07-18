@extends('layouts.layout')
@section('content')
  {{ Form::open(array('url' => '/', 'id' => 'form', 'class' => 'form-horizontal')) }}
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-8">
      {{ Form::email ('email', $consulta->email, array('class'=>'form-control','placeholder'=>'Email', 'autocomplete'=>'of')) }}
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Consulta</label>
    <div class="col-sm-8">
      {{ Form::textarea ('consulta', $consulta->consulta, array('class'=>'form-control','placeholder'=>'Consulta', 'autocomplete'=>'of')) }}
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {{ Form::submit('Enviar',array('class'=>'btn btn-success')) }}
    </div>
  </div>
{{ Form::close() }}
@stop