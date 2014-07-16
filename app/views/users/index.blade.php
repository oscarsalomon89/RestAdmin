@extends('layouts.master')
 
@section('content')
<h1> Usuarios </h1>
    @if(Session::has('notice'))
       <p> <strong> {{ Session::get('notice') }} </strong> </p>
    @endif
    <p> {{ link_to ('users/create', 'Crear nuevo usuario') }} </p>
    @if($users->count())
<div class="widget-content-white glossed">
    <div class="padded">
          <table class="table table-striped table-bordered table-hover datatable">
          <thead>
          <tr>
             <th> Nombre real </th>
             <th> Apellido </th>
             <th> Rol </th>
             <th> </th>
          </tr>
          </thead>
          <tbody>
          @foreach($users as $item)
             <tr>
                <td> {{ $item->name }} </td>
                <td> {{ $item->lastname }} </td>
                <td> {{ $item->role['name'] }} </td>
                <td> {{ link_to('users/'.$item->id, 'Ver') }} </td>
                <td> {{ link_to('users/'.$item->id.'/edit', 'Editar',array('class'=>'btn btn-default btn-xs')) }} </td>
                <td> 
  			{{ Form::open(array('url' => 'users/'.$item->id)) }}
     		 {{ Form::hidden("_method", "DELETE") }}
        <input type="submit" value="Eliminar" class="btn btn-primary btn-xs">
   			{{ Form::close() }}
</td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>
    @else
       <p> No se han encontrado usuarios </p>
    @endif
@stop
