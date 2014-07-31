  <?php
   class OrderController extends BaseController {

      public function index(){
          $orders =Order::where('status',true)->get();
          return View::make('order.index', array('orders' => $orders));
      }


  public function show($id) {
     $order = Order::find($id, array('id','user_id','table_id','status','total'));
     return View::make('order.show', array('order' => $order));
     }

     public function create() { 
      $order = new Order();
      $users = User::all(array('id','name','lastname'));
      $tables = Table::where('state',false)->get();
     return View::make('order.save', array('order' => $order, 'users'=> $users,'tables'=>$tables));
     }

     public function store() { 
      $order = new Order();
      $input = Input::get();
      
      $validator = Order::validate($input);
   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $order->date = $input['date'];
      if(isset($input['user_id'])){
        $order->user_id = $input['user_id'];
      }else{
        $order->user_id = Auth::User()->id;
      }
      $order->table_id = $input['table_id'];
      $order->status = true;
      $order->total='0';
      $table = Table::find($order->table_id);
      $order->table->state = true;
      $order->push();
          return Response::json(array(
            'success'     =>  true,
            'idorder' => $order->id
        ));
   }
}

  public function cobrar($id) {
     $order = Order::find($id, array('id','user_id','table_id','total'));
     return View::make('order.cobrar', array('order' => $order));
     }

  public function save($id) { 
   $order = Order::find($id, array('id','table_id', 'status'));
   $order->status = '0';
   $table = Table::find($order->table_id);
   $table->state = '0';
   $table->save();
   $order->save();
   return Redirect::to('orders')->with('notice', 'La orden ha sido cobrada.');
   }

   public function destroy($id) { 
    // no elimino las ordenes solo las desactivo
   $order = Order::find($id);
   $order->status = false;
   $order->table->state = false;
   $order->push();
   return Redirect::to('orders')->with('notice', 'La Orden ha sido eliminada correctamente.');
   }
}
?>