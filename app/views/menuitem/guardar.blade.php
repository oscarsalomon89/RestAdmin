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
    {{ Form::open(array('url' => 'items/' . $itemmenu->id,'class'=>'form-horizontal')) }}
    <div class="form-group">
       {{ Form::label ('name', 'Nombre') }}
       {{ Form::text ('name', $itemmenu->name, array('class'=>'form-control','placeholder'=>'nombre', 'autocomplete'=>'of')) }}
    </div>
    @if($errors->has('name'))
  <div class="alert alert-danger">
    @foreach($errors->get('name') as $error)
      *{{$error}}<br>
    @endforeach
    </div>
  @endif
    <div class="form-group">
       {{ Form::label ('description', 'Descripcion') }}
       {{ Form::text ('description', $itemmenu->description, array('class'=>'form-control','placeholder'=>'Descripcion', 'autocomplete'=>'of')) }} 
     </div> 
     @if($errors->has('description'))
  <div class="alert alert-danger">
    @foreach($errors->get('description') as $error)
      *{{$error}}<br>
    @endforeach
  </div>
  @endif
       <div class="form-group">
          {{ Form::label ('price', 'Precio') }}
          {{ Form::text ('price',$itemmenu->price,array('class'=>'form-control','placeholder'=>'Precio', 'autocomplete'=>'of')) }}
      </div>
      @if($errors->has('price'))
  <div class="alert alert-danger">
    @foreach($errors->get('price') as $error)
      *{{$error}}<br>
    @endforeach
  </div>
  @endif
       <input type="hidden" class="form-control" id= 'category_id' name="category_id" value='{{$itemcategory->id}}'>
       {{ Form::submit('Guardar item',array('class'=>'btn btn-success')) }}
       {{ link_to('items', 'Cancelar') }}
    {{ Form::close() }}
  </div>
</div>
</div>
</div>
<div class="col-md-4">
  <br>
{{ HTML::image('images/menu-icon.png', "Imagen no encontrada", array('id' => 'principito')) }}
</div>
</div>
@stop