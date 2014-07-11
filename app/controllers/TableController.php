<?php
 class TableController extends BaseController {
    
    public function index(){ 
        $tables = Table::all();
        return View::make('table.index')->with('tables', $tables);
    }

   public function create() { 
   $table = new Table();
   return View::make('table.save')->with('table', $table);
   }

   public function store() { 

   $table = new Table();
   $table->number = Input::get('number');
   $table->quantity = Input::get('quantity');
   $table->state = Input::get('state');

   $validator = Table::validate(Input::all());
   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $table->save();
          return Response::json(array(
            'success'     =>  true
        ));
   }
   }

   public function edit($id) { 
   $table = Table::find($id);
   return View::make('table.save')->with('table', $table);
   }

   public function update($id) { 
   $table = Table::find($id);
   $table->number = Input::get('number');
   $table->quantity = Input::get('quantity');
   $table->state = Input::get('state');
      
   $validator = Table::validate(Input::all(), $table->id);
   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $table->save();
          return Response::json(array(
            'success'     =>  true,
            'types' => 'edit'
        ));
   }
   }

   public function destroy($id) { 
   $category = Category::find($id);
   $category->delete();
   return Redirect::to('categorias')->with('notice', 'La categoria ha sido eliminada correctamente.');
   }
 }
?>