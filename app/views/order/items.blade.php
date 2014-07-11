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
                <td> $ {{$item->pivot->price}}</td>
                <td> $ {{$item->pivot->price * $item->pivot->quantity}}</td>
                <td> <a href='http://localhost/restappadmin/public/index.php/orders/editar/{{$item->id}}' class="btn btn-default btn-xs">Editar</a></td>
              <td>
               {{ Form::open(array('url' => 'orders/edit/'.$order->id, 'id' => 'formulario_delete')) }}
                <input type="hidden" class="form-control" id= 'item_id' name="item_id" value='{{$item->pivot->id}}'>
                <input type="hidden" class="form-control" id= 'price' name="price" value='{{$item->pivot->price * $item->pivot->quantity}}'>
                <input type="hidden" class="form-control" id= 'type_id' name="type_id" value='eliminar'>
               <input type="submit" value="Eliminar" class="btn btn-primary btn-xs">
               {{ Form::close() }}
              </td>
          </tr>
      @endforeach
            <tr>
                <td><h3>Total:<span class="label label-success">$ {{$order->total}}</span></h3></td>
            </tr>
        </table>
    </ul>