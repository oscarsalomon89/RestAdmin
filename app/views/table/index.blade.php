@extends('layouts.master')
 
@section('content')
@section('head')
{{HTML::script('js/delete.js')}}
@stop
<h1> Mesas existentes </h1>
    <p> {{ link_to ('tables/create', 'Crear nueva mesa') }} </p>
    @if($tables->count())
<div class='errors_form'></div>
<div class="widget-content-white glossed">
<div id='tables' class="padded">
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
             <tr id='fila_{{$table->id}}'>
                <td> {{ $table->number }} </td>
                <td> {{ $table->quantity }} </td>
                <td> @if($table->taken == 'false')
                <span class="label label-success">Libre</span>
              @else
                <span class="label label-danger">Ocupada</span>
              @endif</td>
                <td> {{ link_to('tables/'.$table->id.'/edit', 'Editar') }} </td>
                <td>
                <button id="button" value='tables/' onclick="eliminar({{ $table->id }})" class="btn btn-danger btn-xs">Eliminar</button>
               </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>
    @else
       <p> No se han encontrado Mesas</p>
    @endif
<script type="text/javascript">
$(document).ready(function ()
{
$('#table').addClass("active");
});
</script>
@stop
