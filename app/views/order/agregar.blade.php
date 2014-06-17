@extends('layouts.master')
 
@section('content')
<div class="widget">
<div class="widget-content-white glossed">
  <div class="padded">
    @if(Session::has('notice'))
    <div class="alert alert-success">{{ Session::get('notice') }}</div>
    @endif
<h1> Mesa Nro: <span class="badge"><h2>{{ $order->table_id }}</h2></span></h1>
    <ul>
       <li> Mozo: {{ $order->user['name'].' '.$order->user['lastname']}} </li>
       <li> Estado: @if($order->status==1)
            <span class="label label-success">Abierta</span>
              @else
            <span class="label label-success">Cerrada</span>
              @endif
        </li>
      </ul>
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
  {{ Form::open(array('url' => 'orders/agregar/'.$order->id, 'id' => 'formulario_busqueda')) }}
  <input type="hidden" class="form-control" id= 'order_id' name="order_id" value='{{$order->id}}'>
  <div class="col-lg-6">
  <select class="form-control" id="item_id" name="item_id">
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
  {{ Form::submit('Agregar',array('class'=>'btn btn-primary', 'id'=>'enviar')) }}
  </div>
  {{ Form::close() }}
    <!--en este los errores del formulario--> 
<div class='errors_form'></div>
<!--en este el mensaje de registro correcto-->
<div class='success_message alert-box success'></div>
</div> 

<br>
<div class="row">
  {{ Form::open(array('url' => 'orders/agregar')) }}
  <input type="hidden" class="form-control" id= 'order_id' name="order_id" value='{{$order->id}}'>
  <div class="col-lg-6">
  <select class="form-control" name="item_id">
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
  {{ Form::submit('Agregar',array('class'=>'btn btn-default')) }}
  </div>
  {{ Form::close() }}
</div>
</div>
<ul>
  <h3>Items de la orden</h3>
          <table class="table table-striped table-bordered table-hover datatable">
           <tr>
             <th> Item </th>
             <th> Descripcion </th>
             <th> Cantidad </th>
             <th> Precio unitario </th>
             <th> Precio total </th>
          </tr>
       @foreach($order->items as $item)
            <tr>
                <td> {{ $item->name }} </td>
                <td> {{ $item->description }} </td>
                <td> {{ $item->pivot->quantity }} </td>
                <td> {{$item->price}}</td>
                <td> $ {{$item->price*$item->pivot->quantity }}</td>
                @if($item->pivot->quantity!=0)
                <?php $total=$total+$item->price*$item->pivot->quantity; ?>
              @endif
              <td>
                {{ Form::open(array('url' => 'orders/eliminar/'.$item->id)) }}
                <input type="hidden" class="form-control" id= 'order_id' name="order_id" value='{{$order->id}}'>
                <input type="submit" value="Eliminar" class="btn btn-primary btn-xs">
                {{ Form::close() }}
              </td>
            </tr>
      @endforeach
            <tr>
                <td> Total: $ {{$total}}</td>
                <td></td>
            </tr>
    </ul>
  </table>
    <p> {{ link_to('orders', 'Volver') }} </p>
</div>
</div>
</div>
<script type="text/javascript">

$(document).ready(function ()
{
var form = $('#formulario_busqueda');
form.bind('submit', function () {
  $.ajax({
           type: form.attr('method'),
           dataType: "json",
           url: form.attr('action'),
           data: form.serialize(),
           success: function (data)
                  {
                  if(data.success == false){
                        var errores = '';
                        foreach(datos in data.errors){
                            errores += '<small class="error">' + data.errors[datos] + '</small>';
                        }
                        $('.errors_form').html(errores);
                    }else{
                        $(form)[0].reset();//limpiamos el formulario
                        $('.success_message').html(data.message);
                    }
                  }
         }); 
  return false;
});
});
</script>
@stop