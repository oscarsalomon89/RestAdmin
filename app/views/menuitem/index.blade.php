@extends('layouts.master')
 
@section('content')
<h1> Items de menu </h1>
    @if(Session::has('notice'))
       <p> <strong> {{ Session::get('notice') }} </strong> </p>
    @endif
    <p> {{ link_to ('items/create', 'Crear nuevo item') }} </p>
    @if($categories->count())
     @foreach($categories as $category)
     {{ link_to ('items/create/'.$category->id, $category->name, array('class'=>'btn btn-danger')) }}
     @endforeach
     <br>
     <br>
<div class="panel-group" id="accordion">
@foreach($categories as $category)
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#{{$category->name}}">
          {{$category->name}}
        </a>
      </h4>
    </div>
    <div id="{{$category->name}}" class="panel-collapse collapse">
      <div class="panel-body">
      @foreach($category->items as $item)
      <li class="list-group-item">{{$item->name.' - Descripcion: '.$item->description.' - Precio: $'.$item->price.'<br>'.link_to('items/'.$item->id.'/edit', 'Editar').' - '.link_to('items/'.$item->id.'/delete', 'Eliminar')}}</li>
      @endforeach
      </div>
    </div>
  </div>
@endforeach
</div>
    @else
       <p> Primero debe crear las categorias </p>
    @endif
@stop
