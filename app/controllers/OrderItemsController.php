<?php

class OrderItemsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function items($id) {
     $order = Order::find($id);
     return View::make('order.items', array('order' => $order));
     }
     
	 public function edit($id) { 
      $order = Order::find($id);
      $categories = Category::all(array('id','name'));
     return View::make('order.agregar', array('order' => $order,'categories'=>$categories));
     }
  public function store()
  {
    $input = Input::get();
    $validator = ItemOrder::validate($input);

    if(!$validator->fails())
    {
      $orderItem = new ItemOrder();
      $item = Item::find($input['item_id'], array('id','price'));
      $quantity = $input['quantity'];
      $total = $item->price * $quantity;
      //TODO: Deberiamos checkear si la orden existe y está activa.
      $order = Order::find($input['order_id']);
      $order->total += $total;
      $order->save();

      $orderItem = new ItemOrder();
      $orderItem->item_id = $item->id;
      $orderItem->order_id = $order->id;
      $orderItem->quantity = $quantity;
      $orderItem->price = $item->price;
      $orderItem->save();

      return Response::json(array(
        'success'     =>  true,
        'message'     =>  'Se agrego el item correctamente',
        'id' => $orderItem->id
      ));
    }
    else {
      return Response::json(array(
        'success' => false,
        'errors' => $validator->getMessageBag()->toArray()
      ));
    }
  }

  public function editar($id) { 
      $item = Item::find($id);
      $order = Order::find('43', array('id','total'));
      $price = '100';
      $order->total = $order->total - $price;
      $order->save();
      $order->items()->detach($item);
            return Response::json(array(
            'success'     =>  true,
            'message'     =>  'Modifique los datos que desee'
        ));
     }

    public function destroy($iditem, $idorder, $price) { 
      $order = Order::find($idorder, array('id','total'));
      $order->total = $order->total - $price;
      $order->save();
      $item = ItemOrder::find($iditem);      
      $item->delete();
         return Response::json(array(
            'success'     =>  true,
            $item
        ));
     }
}