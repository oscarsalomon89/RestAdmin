@extends('layouts.kitchen')
 
@section('content')
<h1> Ordenes </h1>
    @if(Session::has('notice'))
       <div class="alert alert-success">{{ Session::get('notice') }}</div>
    @endif
    @if($orders->count())
<div class="widget-content-white glossed">
    <div class="padded">
        <div class="row">
        @foreach($orders as $order)
        <div class="col-lg-6">
        @if($order->status == 1)
            <div class="panel panel-success">
            <span class="label label-success pull-right">Mozo: {{$order->user['name'].' '.$order->user['lastname']}}</span>
        @else
            <div class="panel panel-danger">
              <span class="badge pull-right alert-animated">{{$order->user['name'].' '.$order->user['lastname']}}</span>
        @endif
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    {{ HTML::image('images/table.png', "Imagen no encontrada", array('class' => 'img-circle')) }}
                    <h4><span class="label label-success">Mesa Nº {{$order->table['number']}}</span></h4>
                  </div>
                  <div class="col-xs-6 text-right">
                    {{ HTML::image('images/waiter.png', "Imagen no encontrada", array('class' => 'img-circle')) }}
                  </div>
                </div>
              </div>              
                <div class="panel-footer announcement-bottom" style="height:300px;">
                  <button type="button" class="btn btn-primary pull-right">Enviar <i class="fa fa-arrow-circle-right"></i></button>
                  <h3>Items de la orden</h3>
          <table class="table table-striped table-bordered table-hover datatable">
           <tr>
             <th> Item </th>
             <th> Descripcion </th>
             <th> Cantidad </th>
          </tr>
       @foreach($order->items as $item)
            <tr>
                <td> {{ $item->name }} </td>
                <td> {{ $item->description }} </td>
                <td> {{ $item->pivot->quantity }} </td>
                <td> <div class="checkbox"><input type="checkbox"></div></td>
          </tr>
      @endforeach
        </table>
 <ul class="pagination pagination-sm pull-right">
      <li class="disabled"><a href="#">«</a></li>
      <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li><a href="#">»</a></li>
   </ul>
                </div>
            </div>
          </div>
          @endforeach
    </div>
</div>
</div>
    @else
    <div class="alert alert-danger">No existen ordenes a la fecha</div>
    @endif
<script type="text/javascript">
//$(document).ready(parpadear);
function parpadear(){ 
  $('#parp').fadeIn(500).delay(250).fadeOut(500, parpadear) 
}
</script>
@stop