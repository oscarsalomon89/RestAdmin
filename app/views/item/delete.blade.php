@extends('layouts.master')

@section('content')
<h2> Esta seguro que quiere eliminar este item? </h2>
    <ul>
       <li> Nombre: {{ $item->name }} </li>
       <li> Descripcion: {{ $item->description }} </li>
       <li> Precio: {{ $item->price }} </li>
       <li> Categoria: {{ $item->category['name'] }} </li>
    </ul>
    <p>   {{ Form::open(array('url' => 'items/'.$item->id)) }}
      {{ Form::hidden("_method", "DELETE") }}
      {{ Form::submit("Eliminar",array('class'=>'btn btn-success')) }}
   {{ Form::close() }}</p>
    <p> {{ link_to('items', 'Volver atrás') }} </p>
@stop