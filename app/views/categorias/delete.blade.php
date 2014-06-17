@extends('layouts.master')

@section('content')

<h2> Esta seguro que quiere eliminar esta categoria? </h2>
    <ul>
       <li> Nombre: {{ $category->name }} </li>
       <li> Descripcion: {{ $category->description }} </li>
    </ul>
    <p>   {{ Form::open(array('url' => 'categorias/'.$category->id)) }}
      {{ Form::hidden("_method", "DELETE") }}
      {{ Form::submit("Eliminar",array('class'=>'btn btn-success')) }}
   {{ Form::close() }}</p>
    <p> {{ link_to('categorias', 'Volver atrás') }} </p>
@stop