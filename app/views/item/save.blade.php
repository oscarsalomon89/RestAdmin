@extends('layouts.master')

@section('content')
@section('head')
{{HTML::script('js/functions.js')}}
@stop
<div class="row">
<div class="col-md-8">
  <div class="widget">
     <div class="widget-content-white glossed">
     <div class="padded">
<h1> Item de Menu </h1>
<div class='errors_form'></div>
    {{ Form::open(array('url' => 'items/create/' . $item->id, 'id'=>'form')) }}
    <input type="hidden" class="form-control" id= 'link' value='items'>
    <div class="form-group">
       {{ Form::label ('name', 'Nombre') }}
       {{ Form::text ('name', $item->name, array('class'=>'form-control','placeholder'=>'nombre', 'autocomplete'=>'of')) }}
    </div>

    <div class="form-group">
       {{ Form::label ('description', 'Descripcion') }}
       {{ Form::text ('description', $item->description, array('class'=>'form-control','placeholder'=>'Descripcion', 'autocomplete'=>'of')) }} 
     </div> 
    
    <div class="form-group">
          {{ Form::label ('price', 'Precio') }}
          {{ Form::text ('price',$item->price,array('class'=>'form-control','placeholder'=>'Precio', 'autocomplete'=>'of')) }}
      </div>

    <div class="form-group">
      {{ Form::label ('itemcategory', 'Categoria') }}<br>
      <ul class="list-group">
      @foreach($categories as $category)
      @if($category->id==$item->category_id)
        <li class="list-group-item active">
        <span class="badge">{{$categories->count()}}</span>
        {{ Form::radio('category_id', $category->id,true) }}   {{$category->name}}
      </li>
      @else
      <li class="list-group-item">
        <span class="badge">14</span>
        {{ Form::radio('category_id', $category->id) }}   {{$category->name}}
      </li>
      @endif      
      @endforeach
    </ul>
    </div>

       {{ Form::submit('Guardar item',array('class'=>'btn btn-success')) }}
       {{ link_to('items', 'Cancelar') }}
    {{ Form::close() }}
</div>
</div>
</div>
</div>
<div class="col-md-4">
{{ HTML::image('images/menu-icon.png', "Imagen no encontrada", array('id' => 'principito', 'title' => 'El principito')) }}
</div>
</div>
@stop