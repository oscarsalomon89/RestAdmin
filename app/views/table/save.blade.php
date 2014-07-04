@extends('layouts.master')

@section('content')
<div class="row">
<div class="col-md-8">
  <div class="widget">
     <div class="widget-content-white glossed">
     <div class="padded">
<h1> Mesas </h1>
    {{ Form::open(array('url' => 'tables/' . $table->id)) }}
    <div class="form-group">
       {{ Form::label ('number', 'Numero') }}
       {{ Form::text ('number', $table->number, array('class'=>'form-control','placeholder'=>'numero', 'autocomplete'=>'of')) }}
    </div>
    <div class="form-group">
       {{ Form::label ('quantity', 'Cantidad de personas') }}
       {{ Form::text ('quantity', $table->quantity, array('class'=>'form-control','placeholder'=>'cantidad de personas', 'autocomplete'=>'of')) }} 
     </div>
     @if($table->state!=null)
    <input type="hidden" class="form-control" id= 'state' name="state" value='{{$table->state}}'>
    @else
    <input type="hidden" class="form-control" id= 'state' name="state" value='0'>
    @endif
       {{ Form::submit('Guardar mesa',array('class'=>'btn btn-success')) }}
       {{ link_to('categorias', 'Cancelar') }}
    {{ Form::close() }}
</div>
</div>
</div>
</div>
<div class="col-md-4">
@if(isset($errors))
<br>
      @foreach($errors as $item)
      <div class="alert alert-danger">{{ $item }}</div>
      @endforeach
@endif
</div>
</div>
@stop