@extends('layouts.master')

@section('content')
@section('head')
{{HTML::script('js/functions.js')}}
@stop
@if($tables->count())
<div class="widget">
<div class="widget-content-white glossed">
<div class="padded">
<h1> Nueva Orden </h1>
<div class='errors_form'></div>
{{ Form::open(array('url' => 'orders/create/' . $order->id, 'id'=>'form')) }}
<input type="hidden" class="form-control" id= 'link' value='orders'>
<input type="hidden" class="form-control" id= 'date' name="date" value='{{date("Y-m-d")}}'>
<div class="row form-group">
{{ Form::label ('ordertable', 'Mesa') }}
<ul class="list-group">
@foreach($tables as $table)
<div class= 'col-md-3'>
<li id='table_select' value='{{$table->id}}' class="list-group-item">
{{ HTML::image('images/table.png', "Imagen no encontrada", array('class' => 'img-circle')) }}
{{ Form::radio('table_id', $table->id) }}
      <div class='indicators'><h3><span class="label label-success">{{$table->number}}</span></h3>
        </div>
</li>
</div>
@endforeach
</ul>
</div>
      <div class="form-group">
      {{ Form::label ('orderuser', 'Mozo') }}<br>
      <ul class="list-group">
      @foreach($users as $user)
      <div>
      <li id='mozo_select' value='{{$user->id}}' class="list-group-item">
        <span class="badge">10</span>
        {{ Form::radio('user_id', $user->id) }}   {{$user->name.' - '.$user->lastname}}
      </li>
      </div>    
      @endforeach
    </ul>
    </div>
       {{ Form::submit('Crear orden',array('class'=>'btn btn-success')) }}
       {{ link_to('orders', 'Cancelar') }}
    {{ Form::close() }}
  </div>
</div>
</div>
@else
<div class="alert alert-danger">No puede crear la orden porque no se encuentran mesas disponibles</div>
{{ link_to('orders', 'Volver a ordenes') }}
@endif
<script type="text/javascript">
$('ul #table_select').click(function() {
  var valu = $(this).val();
  $('ul #table_select input:radio[value ='+ valu +']').prop('checked',true);
  $('ul #table_select input:radio[id=table_id]').prop( "checked", false);
  $('ul #table_select').removeClass('active');
    $(this).addClass('active');    
});

$('ul #mozo_select').click(function() {
    var valueMozo = $(this).val();
  $('ul #mozo_select input:radio[value ='+ valueMozo +']').prop('checked',true);
  $('ul #mozo_select input:radio[id=table_id]').prop( "checked", false);
  $('ul #mozo_select').removeClass('active');
    $(this).addClass('active');
});
</script>
@stop