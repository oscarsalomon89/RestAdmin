@extends('layouts.master')
 
@section('content')
<h1> Mesas existentes </h1>
    @if(Session::has('notice'))
<div class="alert alert-success">{{ Session::get('notice') }}</div>
    @endif
    <p> {{ link_to ('tables/create', 'Crear nueva mesa') }} </p>
    @if($tables->count())
<div class="widget-content-white glossed">
    <div class="padded">
          <table class="table table-striped table-bordered table-hover datatable">
          <thead>
          <tr>
             <th> Numero </th>
             <th> Cantidad </th>
             <th>Estado</th>
             <th> </th>
          </tr>
          </thead>
          <tbody>
          @foreach($tables as $table)
             <tr>
                <td> {{ $table->number }} </td>
                <td> {{ $table->quantity }} </td>
                <td> @if($table->state ==0)
                <span class="label label-success">Libre</span>
              @else
                <span class="label label-danger">Ocupada</span>
              @endif</td>
                <td> {{ link_to('tables/'.$table->id.'/edit', 'Editar') }} </td>
                <td> {{ link_to('tables/'.$table->id.'/delete', 'Eliminar') }} </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>
    @else
       <p> No se han encontrado Mesas</p>
    @endif
@stop
