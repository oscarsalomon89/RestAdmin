@extends('layouts.master')
 
@section('content')
@section('head')
{{HTML::script('js/delete.js')}}
@stop
<h1> Mesas existentes </h1>
    <p> <a href='tables/create' class="btn btn-primary"><i class="icon-plus"></i> Crear mesa</a> </p>
    @if($tables->count())
<div class='errors_form'></div>
<div class="widget-content-white glossed">
<div id='tables' class="padded">
          <table class="table table-striped table-bordered table-hover datatable">
          <thead>
          <tr>
             <th> Numero </th>
             <th> Descripción </th>
             <th> Cantidad </th>
             <th>Estado</th>
             <th> </th>
          </tr>
          </thead>
          <tbody>
          @foreach($tables as $table)
             <tr id='fila_{{$table->id}}'>
                <td> {{ $table->number }} </td>
                <td> {{ $table->description }} </td>
                <td> {{ $table->seats }} </td>
                <td> @if($table->taken == 'false')
                <span class="label label-success">Libre</span>
              @else
                <span class="label label-danger">Ocupada</span>
              @endif</td>
                <td> <a href='tables/{{$table->id}}/edit' class="btn btn-default btn-xs"><i class="icon-pencil"></i> edit</a></td>
                <td>
                <button id="button" value='tables/' onclick="eliminar({{ $table->id }})" class="btn btn-danger btn-xs"><i class="icon-remove"></i></button>
               </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>
    @else
       <div class="alert alert-danger"> No se han encontrado Mesas</div>
    @endif
<script type="text/javascript">
$(document).ready(function ()
{
$('#table').addClass("active");
});
</script>
@stop
