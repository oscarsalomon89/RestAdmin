  <?php
   class OrderController extends BaseController {
    
  private $autorizado;
   public function __construct() {
      $this->autorizado = (Auth::check() and Auth::user()->role_id == '1');
   } 
      public function index(){
        if(!$this->autorizado) return Redirect::to('/auth/login');
          $orders =Order::where('date','=',date("Y-m-d"))->get();
          return View::make('order.index', array('orders' => $orders));
      }


  public function show($id) {
     $order = Order::find($id, array('id','user_id','table_id','status','total'));
     return View::make('order.show', array('order' => $order));
     }

     public function create() { 
      $order = new Order();
      $users = User::all(array('id','name','lastname'));
      $tables= Table::where('state','=',0)->get();
     return View::make('order.save', array('order' => $order, 'users'=> $users,'tables'=>$tables));
     }

     public function store() { 
      $order = new Order();
      $input = Input::all();
      
      $validator = Order::validate($input);
   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $order->date = $input['date'];
      $order->user_id = $input['user_id'];
      $order->table_id = $input['table_id'];
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