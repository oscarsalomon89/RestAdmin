@extends('layouts.master')
 
@section('content')
<h1> Items de menu </h1>
@if(Session::has('notice'))
       <div class="alert alert-success">{{ Session::get('notice') }}</div>
    @endif
    <p> {{ link_to ('items/create', 'Crear nuevo item') }} </p>
    @if($categories->count())
     @foreach($categories as $category)
     {{ link_to ('item/create/'.$category->id, $category->name, array('class'=>'btn btn-danger')) }}
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
    <div id="{{$category->name}}" class="panel-collapse collapse in">
      <div class="panel-body">
      <table class="table table-striped">
      <thead>
          <tr>
             <th> Codigo </th>
             <th> Nombre </th>
             <th> Descripcion</th>
             <th> Precio</th>
             <th> </th>
          </tr>
          </thead>
          <tbody>
          @foreach($category->items as $item)
             <tr>
                <td> {{ $item->id }} </td>
                <td> {{ $item->name }} </td>
                <td> {{ $item->description }} </td>
                <td> <h4><span class="label label-success">$ {{$item->price}}</span></h4></td>
                <td> {{ link_to('items/'.$item->id.'/edit', 'Editar') }} </td>
                <td> {{link_to('items/'.$item->id.'/delete', 'Eliminar') }}  </td>
             </tr>
          @endforeach
          </tbody>
      </table>
      </div>
    </div>
  </div>
@endforeach
</div>
    @else
       <p> Primero debe crear las categorias </p>
    @endif
@stop
