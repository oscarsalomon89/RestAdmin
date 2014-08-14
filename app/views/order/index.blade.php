@extends('layouts.master')
 
@section('content')
<h1> Ordenes </h1>
    @if(Session::has('notice'))
       <div class="alert alert-success">{{ Session::get('notice') }}</div>
    @endif
    <p> {{ link_to ('orders/create', 'Crear nueva orden') }} </p>
    @if($orders->count())
<div class="widget-content-white glossed">
    <div class="padded">
          <table class="table table-striped table-bordered table-hover datatable">
          <thead>
          <tr>
             <th> Fecha </th>
             <th> Estado </th>
             <th> Mozo </th>
             <th> Mesa </th>
             <th> </th>
          </tr>
          </thead>
          <tbody>
          @foreach($orders as $item)
             <tr>
                <td> {{ $item->date }} </td>
                <td> @if($item->status==1)
                <span id='line' class="label label-success">Abierta</span>
              @else
                <span class="label label-danger">Cerrada</span>
              @endif </td>
                <td> {{$item->user['name']}}</td>
                <td> {{$item->table['number']}}</td>
                <td> {{ link_to('orders/'.$item->id, 'Ver') }} </td>               
                <td>
                @if($item->status==1) 
                  {{ link_to('orders/edit/'.$item->id, 'Editar',array('class'=>'btn btn-default btn-xs')) }} 
                  @endif
                </td>
          <td>
        @if($item->status==1)
        {{ link_to('orders/cobrar/'.$item->id, 'Cobrar',array('class'=>'btn btn-primary btn-xs')) }}
        @endif
                </td>
        <td> 
        {{ Form::open(array('url' => 'orders/'.$item->id)) }}
         {{ Form::hidden("_method", "DELETE") }}
        <input type="submit" value="Eliminar" class="btn btn-primary btn-xs">
        {{ Form::close() }}
        </td>
        <td>{{ link_to('orders/editar/'.$item->id, 'Editar')}}</td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>
    @else
    <div class="alert alert-danger">No existen ordenes a la fecha</div>
    @endif
<script type="text/javascript">
$(document).ready(function ()
{
$('#order').addClass("active");
});
</script>
@stop
