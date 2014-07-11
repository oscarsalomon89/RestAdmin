  <?php
   class OrderController extends BaseController {
    
  private $autorizado;
   public function __construct() {
      $this->autorizado = (Auth::check() and Auth::user()->name == 'Ariel');
   } 
      public function index(){
        if(!$this->autorizado) return Redirect::to('/auth/login');
          $orders =Order::where('date','=',date("Y-m-d"))->get();
          return View::make('order.index', array('orders' => $orders));
      }

    public function items($id) {
     $order = Order::find($id);
     //$items = ItemOrder::where('order_id','=',$order->id)->get();
     //$total = $order->total;
     return View::make('order.items', array('order' => $order));
     }

  public function show($id) {
    if(!$this->autorizado) return Redirect::to('/auth/login');
     $order = Order::find($id, array('id','user_id','table_id','status','total'));
     return View::make('order.show', array('order' => $order));
     }

     public function create() { 
      if(!$this->autorizado) return Redirect::to('/auth/login');
      $order = new Order();
      $users = User::all(array('id','name','lastname'));
      $tables= Table::where('state','=',0)->get();
     return View::make('order.save', array('order' => $order, 'users'=> $users,'tables'=>$tables));
     }

     public function store() { 
      if(!$this->autorizado) return Redirect::to('/auth/login');
      $order = new Order();
      $order->date = Input::get('date');
      $order->user_id = Input::get('user_id');
      $order->table_id = Input::get('table_id');
      
      $validator = Order::validate(Input::all());
   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $order->status = '1';
      $order->total='0';
      $table = Table::find($order->table_id);
      $table->state ='1';
      $table->save();
      $order->save();
          return Response::json(array(
            'success'     =>  true,
            'idorder' => $order->id
        ));
   }
}

  public function editarItems($id) { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
      $order = Order::find($id);
      $categories = Category::all(array('id','name'));
     return View::make('order.agregar', array('order' => $order,'categories'=>$categories));
     }

public function agregarItems($id) {
  if(!$this->autorizado) return Redirect::to('/auth/login');
    $order = Order::find($id, array('id','total'));
  if(Input::get('type_id') == 'edit')
  {
      $rules = array(
          'item_id' => 'required',
          'quantity' => 'required|min:1'
      );
          
      $messages = array(
          'item_id.required'=> 'Ingresar un item es obligatorio.',
          'quantity.required'=> 'Ingresar la cantidad es obligatorio.',
          'quantity.min' => 'La cantidad no puede tener menos de uno.',
      );
          
      $validation = Validator::make(Input::all(), $rules, $messages); 
      if ($validation->fails())
      {
        //como ha fallado el formulario, devolvemos los datos en formato json
      return Response::json(array(
          'success' => false,
          'errors' => $validation->getMessageBag()->toArray()
      )); 
          //en otro caso ingresamos al usuario en la tabla usuarios
      }else{
          $item = Item::find(Input::get('item_id'), array('id','price'));
          $quantity = Input::get('quantity');
          $total = $item->price * $quantity;
          $order->total= $order->total + $total;
          $order->save();
          $order->items()->attach($item, array('quantity'=>$quantity, 'price'=>$item->price));
          return Response::json(array(
            'success'     =>  true,
            'message'     =>  'Se agrego el item correctamente'
        ));
      }
    }
    else{
      $item = ItemOrder::find(Input::get('item_id'));      
      $precio = Input::get('price');
      $order->total = $order->total - $precio;
      $order->save();
      $item->delete();
      return Redirect::to('orders/edit/'.$order->id)->with('notice', 'el item ha sido eliminado correctamente.');
    }
}

  public function editar($id) { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
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
    public function eliminarItems($id) { 
      $order = Order::find(Input::get('order_id'), array('id','total'));
      $item = Item::find($id, array('id'));
      $precio = Input::get('item_price');
      $order->total = $order->total - $precio;
      $order->save();
      $order->items()->detach($item);
            return Response::json(array(
            'success'     =>  true,
            'message'     =>  'item eliminado'
        ));
     }

   public function cobrar($id) {
    if(!$this->autorizado) return Redirect::to('/auth/login');
     $order = Order::find($id, array('id','user_id','table_id','total'));
     return View::make('order.cobrar', array('order' => $order));
     }

    public function save($id) { 
      if(!$this->autorizado) return Redirect::to('/auth/login');
   $order = Order::find($id, array('id','table_id', 'status'));
   $order->status = '0';
   $table = Table::find($order->table_id);
   $table->state = '0';
   $table->save();
   $order->save();
   return Redirect::to('orders')->with('notice', 'La orden ha sido cobrada.');
   }

   public function destroy($id) { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
   $order = Order::find($id);
   foreach ( $order->items as $item) {
   $order->items()->detach($item);
   }
   $table = Table::find($order->table_id);
   $table->state = '0';
   $table->save();
   $order->delete();
   return Redirect::to('orders')->with('notice', 'La Orden ha sido eliminada correctamente.');
   }
}
?>