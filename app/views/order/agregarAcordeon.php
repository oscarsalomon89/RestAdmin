<div class="panel-group" id="accordion">
  @foreach($categories as $category)
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#{{$category->name}}">
          {{$category->name}}
        </a>
      </h4>
    </div>
    <div id="{{$category->name}}" class="panel-collapse collapse">
      <div class="panel-body">
         <div class="row">
<div class="col-md-8">
  <div class="widget">
     <div class="padded">
    <h2>{{$category->name}}</h2>
    {{ Form::open(array('url' => 'orders/agregar')) }}
    <br>
    <input type="hidden" class="form-control" id= 'order_id' name="order_id" value='{{$order->id}}'>
    <div class="form-group">
      <ul class="list-group">
      @foreach($category->items as $item)
      <li class="list-group-item ">
        <span class="badge">10</span>
        {{ Form::radio('item_id', $item->id) }}   {{$item->name.' - '.$item->description}}
      </li>     
      @endforeach
    </ul>
    </div>
        @if($errors->has('item_id'))
  <div class="alert alert-danger">
    @foreach($errors->get('item_id') as $error)
      *{{$error}}<br>
    @endforeach
    </div>
  @endif
      <div class="form-group">
       {{ Form::label ('cantidad', 'Cantidad') }}
       <input class="form-control" placeholder="cantidad" autocomplete="of" name="quantity" type="text" id="quantity">
    </div>
    @if($errors->has('quantity'))
  <div class="alert alert-danger">
    @foreach($errors->get('quantity') as $error)
      *{{$error}}<br>
    @endforeach
    </div>
  @endif
       {{ Form::submit('Agregar',array('class'=>'btn btn-success')) }}
    {{ Form::close() }}
</div>
</div>
</div>
</div>
      </div>
    </div>
  </div>
@endforeach
</div>