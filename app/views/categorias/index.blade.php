@extends('layouts.master')
 
@section('content')
@section('head')
{{HTML::script('js/delete.js')}}
@stop
<h1> Categorias de menu </h1>
<a href='categorias/create' class='btn-primary'>Crear nueva categoria</a>
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
                <td> {{ link_to('categorias/'.$category->id.'/edit', 'Editar',array('class'=>'btn btn-default btn-xs')) }} </td>
                <td> <button id="button" value='categorias/' onclick="eliminar({{ $category->id }})" class="btn btn-danger btn-xs">Eliminar</button> </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>
    @else
       <p> No se han encontrado categorias de menu </p>
    @endif
<script type="text/javascript">
$(document).ready(function ()
{
$('#cat').addClass("active");
});
</script>
@stop
