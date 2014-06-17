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
<h1> Categorias </h1>
    {{ Form::open(array('url' => 'categorias/' . $category->id)) }}
    <div class="form-group">
       {{ Form::label ('name', 'Nombre') }}
       {{ Form::text ('name', $category->name, array('class'=>'form-control','placeholder'=>'nombre', 'autocomplete'=>'of')) }}
    </div>
    <div class="form-group">
       {{ Form::label ('description', 'Descripcion') }}
       {{ Form::text ('description', $category->description, array('class'=>'form-control','placeholder'=>'Descripcion', 'autocomplete'=>'of')) }} 
     </div> 
       {{ Form::submit('Guardar categoria',array('class'=>'btn btn-success')) }}
       {{ link_to('categorias', 'Cancelar') }}
    {{ Form::close() }}
</div>
</div>
</div>
</div>
<div class="col-md-4">
</div>
</div>
@stop