@extends('layouts.master')

@section('content')
<h2> Esta seguro que quiere eliminar este item? </h2>
    <ul>
       <li> Nombre: {{ $itemmenu->name }} </li>
       <li> Descripcion: {{ $itemmenu->description }} </li>
       <li> Precio: {{ $itemmenu->price }} </li>
       <li> Categoria: {{ $itemmenu->category['name'] }} </li>
    </ul>
    <p>   {{ Form::open(array('url' => 'items/'.$itemmenu->id)) }}
      {{ Form::hidden("_method", "DELETE") }}
      {{ Form::submit("Eliminar",array('class'=>'btn btn-success')) }}
   {{ Form::close() }}</p>
    <p> {{ link_to('items', 'Volver atrás') }} </p>
@stop