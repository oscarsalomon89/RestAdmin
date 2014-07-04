<?php
 class TableController extends BaseController {
    
    public function index(){
        
        $tables = Table::all(array('id','number','quantity','state'));
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
      $errors = $validator->messages()->all();
      return View::make('table.save')->with('table', $table)->with('errors', $errors);
   }else{
      $table->save();
      return Redirect::to('tables')->with('notice', 'La Mesa ha sido creada correctamente.');
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
      $errors = $validator->messages()->all();
      return View::make('table.save')->with('table', $table)->with('errors', $errors);
   }else{
      $table->save();
      return Redirect::to('tables')->with('notice', 'La mesa ha sido modificada correctamente.');
   }
   }

   public function destroy($id) { 
   $category = Category::find($id);
   $category->delete();
   return Redirect::to('categorias')->with('notice', 'La categoria ha sido eliminada correctamente.');
   }
 }
?>