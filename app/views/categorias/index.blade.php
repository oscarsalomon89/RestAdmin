@extends('layouts.master')
 
@section('content')
<h1> Categorias de menu </h1>
@if(Session::has('notice'))
       <div class="alert alert-success">{{ Session::get('notice') }}</div>
    @endif
<p><a href='categorias/create' class='btn-primary'><i class="fa fa-plus"></i>Crear nueva categoria</a></p>
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
             <tr>
                <td> {{ $category->name }} </td>
                <td> {{ $category->description }} </td>
                <td> {{ link_to('categorias/'.$category->id.'/edit', 'Editar') }} </td>
                <td> {{ link_to('categorias/'.$category->id.'/delete', 'Eliminar') }} </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>
    @else
       <p> No se han encontrado categorias de menu </p>
    @endif
@stop
