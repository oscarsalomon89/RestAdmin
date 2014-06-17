  <?php
   class OrderController extends BaseController {
      
      public function index(){
          $orders =Order::where('date','=',date("Y-m-d"))->get();
          //$orders = Order::all( array('date','status','user_id','table_id'));
          return View::make('order.index', array('orders' => $orders));
      }
  public function finalizar($id) {
     $order = Order::find($id, array('id'));
     $order->total=Input::get('total');
     $total=$order->total;
     foreach($order->items as $item){
     $price=$item->price*$item->pivot->quantity;
     $total=$total+$item->price*$item->pivot->quantity;
     }
     return View::make('order.show', array('order' => $order, 'total'=>$total));
     }

  public function show($id) {
     $order = Order::find($id, array('id','user_id','table_id','status'));
     $total='0';
     foreach($order->items as $item){
     $price=$item->price*$item->pivot->quantity;
     $total=$total+$item->price*$item->pivot->quantity;
     }
     return View::make('order.show', array('order' => $order, 'total'=>$total));
     }

     public function create() { 
      $order = new Order();
      $users = User::all(array('id','name','lastname'));
      $tables= Table::where('state','=',0)->get();
     return View::make('order.save', array('order' => $order, 'users'=> $users,'tables'=>$tables));
     }

     public function store() { 
      $respuesta = array();
 
        $reglas =  array(
       'date' => 'required|date',
      'user_id' => 'required',
      'table_id'=>'required',
        );
        $input=Input::all();
        $validator = Validator::make($input, $reglas);
        
        if ($validator->fails()){
            $respuesta['notice'] = $validator;
            $respuesta['error']   = true;
        }else{
            $order = new Order();
            $order->date = Input::get('date');
            $order->user_id = Input::get('user_id');
            $order->table_id = Input::get('table_id');
            $order->status = '1';
            $table = Table::find($order->table_id);
            $table->state ='1';
            $table->save();
            $order->save();
                               
            $respuesta['notice'] = 'Orden creada!';
            $respuesta['id'] = $order->id;
            $respuesta['error']   = false;
            $respuesta['data']    = $order;
        }
          
          if ($respuesta['error'] == true){
              return Redirect::to('orders/create')->withErrors($respuesta['notice'] )->withInput();
          }else{
              $order = Order::find($respuesta['id']);
              $categories = Category::all(array('id','name'));
              $total='0';
              return View::make('order.agregar', array('order' => $order,'categories'=>$categories, $respuesta['notice'],'total'=>$total));
          }
     }

  public function insertarItems($id) { 
      $order = Order::find($id);
      $categories = Category::all(array('id','name'));
      $total='0';
     return View::make('order.agregar', array('order' => $order,'categories'=>$categories, 'total'=>$total));
     }

    public function eliminarItems($id) { 
      $order = Order::find(Input::get('order_id'));
      $item = Item::find($id);
      $order->items()->detach($item);
      $respuesta = array();
      $respuesta['notice']="El item ha sido eliminado correctamente";
      $categories = Category::all(array('id','name'));
      $total='0';
      return Redirect::to('orders/agregar/'.$order->id)->with('notice', $respuesta['notice']);
     }

  public function guardarItems() { 
    $order = Order::find(Input::get('order_id'));
    $reglas =  array(
      'item_id' => 'required',
      'quantity'=>'required'
        );
    $input = Input::all();
    $validator = Validator::make($input, $reglas);
  if ($validator->fails()){
            $respuesta['notice'] = $validator;
            $respuesta['error']   = true;
            return Redirect::to('orders/agregar/'.$order->id)->withErrors($respuesta['notice'] )->withInput();
        }
  else{
  $item = Item::find(Input::get('item_id'));
  $quantity = Input::get('quantity');
  $order->items()->attach($item, array('quantity'=>$quantity));
  $respuesta = array();
  $respuesta['notice']="El item se agrego correctamente";
      $categories = Category::all(array('id','name'));
      $total='0';
      return Redirect::to('orders/agregar/'.$order->id)->with('notice', $respuesta['notice']);
     }
   }
public function agregarItems() {
  $order = Order::find(Input::get('order_id'));
      $registerData = array(
          'item_id' => Input::get('item_id'),
          'quantity' => Input::get('quantity')
      );
          
      $rules = array(
          'item_id' => 'required',
          'quantity' => 'required|min:1'
      );
          
      $messages = array(
          'required'=> 'El campo :attribute es obligatorio.',
          'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
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
          $item = Item::find(Input::get('item_id'));
          $quantity = Input::get('quantity');
          $order->items()->attach($item, array('quantity'=>$quantity));
          return Response::json(array(
            'success'     =>  true,
            'message'     =>  'Se agrego el item correctamente'
        ));
      }
}
   public function cobrar($id) {
     $order = Order::find($id, array('id','user_id','table_id'));
     $total='0';
     foreach($order->items as $item){
     $price=$item->price*$item->pivot->quantity;
     $total=$total+$item->price*$item->pivot->quantity;
     }
     return View::make('order.cobrar', array('order' => $order, 'total'=>$total));
     }

    public function save($id) { 
   $order = Order::find($id);
   $order->status='0';
   $table = Table::find($order->table_id);
   $table->state='0';
   $table->save;
   $order->save();
   return Redirect::to('orders')->with('notice', 'La orden ha sido cobrada.');
   }

   public function destroy($id) { 
   $order = Order::find($id);
   $table = Table::find($order->table_id);
   $table->state ='0';
   $table->save();
   $order->delete();
   return Redirect::to('orders')->with('notice', 'La Orden ha sido eliminada correctamente.');
   }
}
?>