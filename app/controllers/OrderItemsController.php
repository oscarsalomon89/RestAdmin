<?php

class OrderItemsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index($id) {
     $order = Order::find($id);
     return View::make('order.items', array('order' => $order));
     }
     
	 public function edit($id) { 
      $order = Order::find($id);
      $categories = Category::all(array('id','name'));
     return View::make('order.agregar', array('order' => $order,'categories'=>$categories));
     }
	public function store($id) {
    $order = Order::find($id, array('id','total'));
    $input = Input::get(); 
      $validator = ItemOrder::validate($input);
 
      if ($validator->fails())
      {
        //como ha fallado el formulario, devolvemos los datos en formato json
      return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      )); 
          //en otro caso ingresamos al usuario en la tabla usuarios
      }else{
          $item = Item::find($input['item_id'], array('id','price'));
          $quantity = $input['quantity'];
          $total = $item->price * $quantity;
          $order->total += $total;
          $order->save();

          $itemOrder = new ItemOrder();
          $itemOrder->item_id = $input['item_id'];
		      $itemOrder->order_id = $id;
		      $itemOrder->quantity = $input['quantity'];
		      $itemOrder->price = $item->price;
		      $itemOrder->save();
          //$order->items()->attach($item, array('quantity'=>$quantity, 'price'=>$item->price));
          return Response::json(array(
            'success'     =>  true,
            'message'     =>  'Se agrego el item correctamente'
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
            'success'     =>  true
        ));
     }
}