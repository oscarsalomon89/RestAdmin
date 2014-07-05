@extends('layouts.master')

@section('content')
@if(isset($errors))
      @foreach($errors as $item)
         <h5 class="alert alert-danger"> {{ $item }} </h5>
      @endforeach
@endif
@if($tables->count())
<div class="row">
<div class="col-md-8">
  <div class="widget">
     <div class="widget-content-white glossed">
     <div class="padded">
<h1> Nueva Orden </h1>
    {{ Form::open(array('url' => 'orders/' . $order->id)) }}

  <input type="hidden" class="form-control" id= 'date' name="date" value='{{date("Y-m-d")}}'>

      <div class="form-group">
      {{ Form::label ('orderuser', 'Mozo') }}<br>
      <ul class="list-group">
      @foreach($users as $user)
      @if($user->id==$order->user_id)
        <li class="list-group-item active">
        <span class="badge">{{$users->count()}}</span>
        {{ Form::radio('user_id', $user->id,true) }}   {{$user->name.' - '.$user->lastname}}
      </li>
      @else
      <li class="list-group-item">
        <span class="badge">10</span>
        {{ Form::radio('user_id', $user->id) }}   {{$user->name.' - '.$user->lastname}}
      </li>
      @endif      
      @endforeach
    </ul>
    </div>
    <div class="form-group">
      {{ Form::label ('ordertable', 'Mesa') }}
      <ul class="list-group">
      @foreach($tables as $table)
      @if($table->state=='0')
      <li class="list-group-item">
        <span class="badge">10</span>
        {{ Form::radio('table_id', $table->id) }}   Mesa numero: {{$table->number.' - Capacidad:'.$table->quantity}}
      </li>
      @endif
      @endforeach
    </ul>
    </select>
    </div>
       {{ Form::submit('Crear orden',array('class'=>'btn btn-success')) }}
       {{ link_to('orders', 'Cancelar') }}
    {{ Form::close() }}
  </div>
</div>
</div>
</div>
<div class="col-md-4">
{{ HTML::image('images/order.png', "Imagen no encontrada", array('id' => 'orderIco')) }}
</div>
</div>
@else
<div class="alert alert-danger">No puede crear la orden porque no se encuentran mesas disponibles</div>
{{ link_to('orders', 'Volver a ordenes') }}
@endif
@stop