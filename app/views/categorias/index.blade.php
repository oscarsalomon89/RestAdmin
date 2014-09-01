@extends('layouts.master')
 
@section('content')
@section('head')
{{HTML::script('js/delete.js')}}
@stop
<h1> CATEGORIAS DEL MENU </h1>
<p><a href='categorias/create' class="btn btn-primary"><i class="icon-plus"></i> Crear categoria</a></p>
<div class='errors_form'></div>
    @if($categories->count())
<div class="widget-content-white glossed">
    <div class="padded">
          <table class="table table-striped table-bordered table-hover datatable">
          <thead>
          <tr>
             <th> Nombre </th>
             <th> Descripcion </th>
             <th> </th>
          </tr>
          </thead>
          <tbody>
          @foreach($categories as $category)
             <tr id='fila_{{$category->id}}'>
                <td> {{ $category->name }} </td>
                <td> {{ $category->description }} </td>
                <td> <a href='categorias/{{$category->id}}/edit' class="btn btn-default btn-xs"><i class="icon-pencil"></i> edit</a> </td>
                <td> <button id="button" value='categorias/' onclick="eliminar({{ $category->id }})" class="btn btn-danger btn-xs"><i class="icon-remove"></i></button> </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>
    @else
       <div class="alert alert-danger"> No se han encontrado categorias de menu </div>
    @endif
<script type="text/javascript">
$(document).ready(function ()
{
$('#cat').addClass("active");
});
</script>
@stop
