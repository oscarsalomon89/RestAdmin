@extends('layouts.master')
 
@section('content')
<div class="widget">
<div class="widget-content-white glossed">
  <div class="padded">

<h1> Mesa Nro: <span class="badge"><h2>{{ $order->table['number'] }}</h2></span></h1>
    <ul>
       <li> Mozo: {{ $order->user['name'].' '.$order->user['lastname']}} </li>
       <li> Estado: @if($order->active==true)
            <span class="label label-success">Abierta</span>
              @else
            <span class="label label-danger">Cerrada</span>
              @endif
        </li>
      </ul>
@if($order->active==true)
<h3>Seleccione los items que desea agregar</h1>
  <div class="jumbotron">
  <div class="row">
  {{ Form::open(array('url' => 'orders/edit', 'id' => 'formulario_busqueda')) }}
  <input type="hidden" class="form-control" id= 'order_id' name="order_id" value='{{$order->id}}'>
  <div class="col-lg-6">
  <select class="form-control" id="item_id" name="item_id">
    <option value=""></option>
    @foreach($categories as $category)
    <optgroup label="{{$category->name}}">
    @foreach($category->items as $item)
      <option value="{{$item->id}}">{{$item->name}} Precio: ${{$item->price}}</option>
    @endforeach
    </optgroup>
    @endforeach
  </select>
  </div>
    <div class="col-lg-3">
        <input class="form-control" placeholder="cantidad" autocomplete="of" name="quantity" type="text" id="quantity">
  </div>
  <div class="col-lg-3">
  {{ Form::submit('Agregar',array('class'=>'btn btn-primary')) }}
  </div>
  {{ Form::close() }}
</div>
<div class='row'>
    <!--en este los errores del formulario--> 
<div id='message'></div>
</div>
</div>
@else
<input type="hidden" class="form-control" id= 'order_id' name="order_id" value='{{$order->id}}'>
  <div class="alert alert-danger">No puede editar esta orden, Ya fue cobrada!</div>
@endif
<div id="tabla">
</div>
    <p> {{ link_to('orders', 'Volver') }} </p>
</div>
</div>
</div>
<script type="text/javascript">

$(document).ready(function ()
{
var id=$("#order_id").val();
$("#tabla").load('list/'+id);
var form = $('#formulario_busqueda');
form.on('submit', function () {
  $.ajax({
           type: form.attr('method'),
           dataType: "json",
           url: form.attr('action'),
           data: form.serialize(),
           success: function (data)
                  {
                  if(data.success == false){
                        var errores = '';
                        for(datos in data.errors){
                            errores +=  data.errors[datos]+'<br>';
                        }
                        $('#message').addClass("alert alert-danger");
                        $('#message').html(errores);
                    }else{
                        $(form)[0].reset();//limpiamos el formulario
                        $('#message').removeClass("alert alert-danger");
                          mensaje = data.message;
                        $('#message').addClass("alert alert-success");
                        $('#message').html(mensaje);
                        $("#tabla").load('list/'+id);
                    }
                  }
         }); 
  return false;
});
});
</script>
@stop