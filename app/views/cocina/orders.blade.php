@if($quantOrders)
<input type="hidden" id= 'quantity' value='{{$quantOrders}}'>
<input type="hidden" id= 'quantitems' value='{{$quantItems}}'>
    <div class="padded">
        <div class="row">
        @foreach($orders as $order)
        <div class="col-lg-6">
        @if($order->active == true)
            <div class="panel panel-success">
            <span class="label label-success pull-right">Mozo: {{$order->user['firstname'].' '.$order->user['lastname']}}</span>
        @else
            <div class="panel panel-danger">
              <span class="badge pull-right alert-animated">Mozo: {{$order->user['firstname'].' '.$order->user['lastname']}}</span>
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
 <!--<ul class="pagination pagination-sm pull-right">
      <li class="disabled"><a href="#">«</a></li>
      <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li><a href="#">»</a></li>
   </ul>-->
                </div>
            </div>
          </div>
          @endforeach
    </div>
</div>
    @else
    <div class="alert alert-danger">No existen ordenes a la fecha</div>
    @endif
<script type="text/javascript">
var cantOrders = $("#quantity").val();
var cantItems = $("#quantitems").val();
setInterval(
  function(){
$.post('listOrders/' + cantOrders + '/'+cantItems, 
            function(data){
                if (data.success == true){
                    var mensaje = 'Nueva orden';
                    $('.errors_form').addClass( "alert alert-danger error" );
                    $('.errors_form').html(mensaje);
                    $("#tableOrders").load('listOrders');
                }
                else{
                  $('.errors_form').removeClass( "alert alert-danger error" );
                  $('.errors_form').html('');
                  //$("#tableOrders").load('listOrders');
                }
            });  
  },
5000);
</script>