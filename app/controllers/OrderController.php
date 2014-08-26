  <?php
   class OrderController extends BaseController {

      public function index(){
          $orders =Order::where('status',true)->get();
          return View::make('order.index', array('orders' => $orders));
      }


  public function show($id) {
     $order = Order::find($id);
     if (Request::wantsJson())
    {
      return Response::json($order);
    }else{
      return View::make('order.show', array('order' => $order));
    }
  }

     public function create() { 
      $order = new Order();
      $users = User::all(array('id','name','lastname'));
      $tables = Table::where('taken',false)->get();
      $title = 'Nueva';
     return View::make('order.save', array('order' => $order, 'users'=> $users,'tables'=>$tables,'title'=>$title));
     }

     public function store() { 
      
      $input = Input::get();
      $validator = Order::validate($input);
      
   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }

    $table = Table::find($input['table_id']);
    if(!$table->taken){
      $order = new Order();
      
      if(isset($input['user_id'])){
        $order->user_id = $input['user_id'];
      }else{
        $order->user_id = Auth::User()->id;
      }
      $order->table_id = $table->id;
      $order->table->taken = true;
      $order->push();
          return Response::json(array(
            'success'     =>  true,
            'idorder' => $order->id
        ));
      }else{

      return Response::json(array(
          'success' => false,
          'errors' => 'Table is taken'
      )); 
    }
}

   public function edit($id) { 
    $order = Order::find($id);
    $tables = Table::all(array('id','number', 'taken'));
    $users = User::all();
    $title = 'Editar';
  return View::make('order.save', array('order' => $order, 'tables' => $tables, 'users' => $users, 'title' => $title));
   }

   public function update($id){

        $input = Input::get();
        $order = Order::find($id);
        $validator = Order::validate($input, $order->id);
        if ($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
          ));
        }else{        
        $table = Table::find($order->table_id);
        $table->taken= false;
        $table->save();

        $table = Table::find($input['table_id']);
        $order->table_id = $table->id;
        $order->user_id = $input['user_id'];
        $order->table->taken = true;
        $order->push();
             return Response::json(array(
          'success' => true,
          'idorder' => $id
      ));
        }
   }

  public function cobrar($id) {
     $order = Order::find($id, array('id','user_id','table_id','total'));
     return View::make('order.cobrar', array('order' => $order));
     }

  public function save($id) { 
   $order = Order::find($id, array('id','table_id', 'status'));
   $order->status = false;
   $order->table->taken = false;
   $order->push();
   return Redirect::to('orders')->with('notice', 'La orden ha sido cobrada.');
   }

   public function destroy($id) { 
    // no elimino las ordenes solo las desactivo
   $order = Order::find($id);
   //$order->status = false;
  $table = Table::find($order->table_id);
  $table->taken= false;
   $table->save();
   $order->delete();
   return Redirect::to('orders')->with('notice', 'La Orden ha sido eliminada correctamente.');
   }
}
?>