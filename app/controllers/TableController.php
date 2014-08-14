<?php
 class TableController extends BaseController {
    
  public function index(){ 
    $tables = Table::all();
    if (Request::wantsJson())
    {
      return Response::json($tables);
    }else{
      return View::make('table.index', array('tables' => $tables));
    }
    }

  public function show($id)
  {
    $table  = Table::find($id);
    if (Request::wantsJson())
    {
      return Response::json($table);
    }else{
      return View::make('table.show', array('table' => $table));
    }
  }

   public function create() { 
   $table = new Table();
   return View::make('table.save', array('table' => $table));
   }

   public function store() { 
   $input = Input::get();
   $validator = Table::validate($input);

   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }
   $table = new Table();
   $table->number = $input['number'];
   $table->quantity = $input['quantity'];
   $table->taken = false;
   $table->save();
          return Response::json(array(
            'success'     =>  true
        ));
   }

   public function edit($id) { 
   $table = Table::find($id);
   return View::make('table.save')->with('table', $table);
   }

   public function update($id) { 
   $table = Table::find($id);
   $input = Input::get();
      
   $validator = Table::validate($input, $table->id);
   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $table->number = $input['number'];
      $table->quantity = $input['quantity'];
      $table->save();
          return Response::json(array(
            'success'     =>  true,
            'types' => 'edit'
        ));
   }
   }

   public function destroy($id) { 
   $table = Table::find($id);
   $table->delete();
   return Response::json(array(
            'success'     =>  true
        ));
   }
 }
?>