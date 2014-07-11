@extends('layouts.master')
 
@section('content')
<div class="widget">
<div class="widget-content-white glossed">
  <div class="padded">
    @if(Session::has('notice'))
    <div class="alert alert-success" id='del'>{{ Session::get('notice') }}</div>
    @endif
<h1> Mesa Nro: <span class="badge"><h2>{{ $order->table['number'] }}</h2></span></h1>
    <ul>
       <li> Mozo: {{ $order->user['name'].' '.$order->user['lastname']}} </li>
       <li> Estado: @if($order->status==1)
            <span class="label label-success">Abierta</span>
              @else
            <span class="label label-danger">Cerrada</span>
              @endif
        </li>
      </ul>
@if($order->status==1)
<h3>Seleccione los items que desea agregar</h1>
  <div class="jumbotron">
  @if($errors->has('quantity'))
  <div class="alert alert-danger">
    @foreach($errors->get('quantity') as $error)
      *{{$error}}<br>
    @endforeach
    </div>
  @endif
  <div class="row">
  {{ Form::open(array('url' => 'orders/edit/'.$order->id, 'id' => 'formulario_busqueda')) }}
  <input type="hidden" class="form-control" id= 'order_id' name="order_id" value='{{$order->id}}'>
  <input type="hidden" class="form-control" id= 'type_id' name="type_id" value='edit'>
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
    <!--en este los errores del formulario--> 
<div class="cold-md-6 col-md-offset-3">
<div class='errors_form'></div>
<!--en este el mensaje de registro correcto-->
<div class='success_message alert-box success'></div>
</div>
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
                            errores += '<small class="alert alert-danger error">' + data.errors[datos] + '<br>' + '</small>';
                        }
                        $('#del').html('');
                        $('#del').removeClass( "alert alert-success" )
                        $('.success_message').html("");
                        $('.errors_form').html(errores);
                    }else{
                        $(form)[0].reset();//limpiamos el formulario
                        $('.errors_form').html("");
                          mensaje = '<small class="alert alert-success">' + data.message + '</small>';
                        $('.success_message').html(mensaje);
                        $('#del').html('');
                        $('#del').removeClass( "alert alert-success" )
                        $("#tabla").load('list/'+id);
                    }
                  }
         }); 
  return false;
});

var idbtn = $('#btn_edit').val();
$('#btn_edit').on('click', function () {
  $.ajax({
           type: 'post',
           dataType: "json",
           url: '/orders/editar/'+idbtn,
           success: function (data)
                  {
                  if(data.success == true){
                  $(form)[0].reset();//limpiamos el formulario
                  $('.errors_form').html("");
                  $('.success_message').html(data.message);
                  $("#tabla").load('list/'+id);
                  }
                }
         }); 
  return false;
});
});
</script>
@stop