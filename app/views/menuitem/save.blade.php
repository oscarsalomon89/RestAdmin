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
<h1> Item de Menu </h1>
    {{ Form::open(array('url' => 'items/' . $itemmenu->id)) }}
    <div class="form-group">
       {{ Form::label ('name', 'Nombre') }}
       {{ Form::text ('name', $itemmenu->name, array('class'=>'form-control','placeholder'=>'nombre', 'autocomplete'=>'of')) }}
    </div>

    <div class="form-group">
       {{ Form::label ('description', 'Descripcion') }}
       {{ Form::text ('description', $itemmenu->description, array('class'=>'form-control','placeholder'=>'Descripcion', 'autocomplete'=>'of')) }} 
     </div> 
    
    <div class="form-group">
          {{ Form::label ('price', 'Precio') }}
          {{ Form::text ('price',$itemmenu->price,array('class'=>'form-control','placeholder'=>'Precio', 'autocomplete'=>'of')) }}
      </div>

    <div class="form-group">
      {{ Form::label ('itemcategory', 'Categoria') }}<br>
      <ul class="list-group">
      @foreach($itemcategories as $category)
      @if($category->id==$itemmenu->category_id)
        <li class="list-group-item active">
        <span class="badge">{{$itemcategories->count()}}</span>
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
    @if($errors->has('name'))
  <div class="alert alert-danger">
    @foreach($errors->get('name') as $error)
      *{{$error}}<br>
    @endforeach
    </div>
  @endif
   @if($errors->has('description'))
  <div class="alert alert-danger">
    @foreach($errors->get('description') as $error)
      *{{$error}}<br>
    @endforeach
  </div>
  @endif
@if($errors->has('price'))
  <div class="alert alert-danger">
    @foreach($errors->get('price') as $error)
      *{{$error}}<br>
    @endforeach
  </div>
  @endif
  @if($errors->has('category_id'))
  <div class="alert alert-danger">
    @foreach($errors->get('category_id') as $error)
      *{{$error}}<br>
    @endforeach
  </div>
  @endif
</div>
</div>
@stop