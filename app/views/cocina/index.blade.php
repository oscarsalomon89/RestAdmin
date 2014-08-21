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
        @if($order->status == 1)
          <div class="col-lg-4" id='parp' onload="parpadear()">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    {{ HTML::image('images/table.png', "Imagen no encontrada", array('class' => 'img-circle')) }}
                    <h4><span class="label label-success">Mesa Nº {{$order->table['number']}}</span></h4>
                  </div>
                  <div class="col-xs-6 text-right">
                    {{ HTML::image('images/waiter.png', "Imagen no encontrada", array('class' => 'img-circle')) }}
                    <h4><span class="label label-success">Mozo: {{$order->user['name'].' '.$order->user['lastname']}}</span></h4>
                  </div>
                </div>
              </div>              
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      View Order
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @else
          <div class="col-lg-4">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-8">
                    {{ HTML::image('images/table.png', "Imagen no encontrada", array('class' => 'img-circle')) }}
                  </div>
                  <div class="col-xs-4 text-right">
                    <h4><span class="label label-success">{{$order->table['number']}}</span></h4>
                  </div>
                </div>
                <span class="label label-success">Mozo: {{$order->user['name'].' '.$order->user['lastname']}}</span>
              </div>              
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      View Order
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif
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