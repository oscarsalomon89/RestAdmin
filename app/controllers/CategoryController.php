<?php
 class CategoryController extends BaseController {
    
   public function index() {
   $categories = Category::all();
   return View::make('categorias.index')->with('categories', $categories);
   }
   public function show($id) { 
   $category = Category::find($id);
   return View::make('categorias.delete')->with('category', $category);
   }
   public function create() { 
   $category = new Category();
   return View::make('categorias.save')->with('category', $category);
   }

   public function store() { 

   $category = new Category();
   $category->name = Input::get('name');
   $category->description = Input::get('description');

   $validator = Category::validate(Input::all());
   if($validator->fails()){
      $errors = $validator->messages()->all();
      return View::make('categorias.save')->with('category', $category)->with('errors', $errors);
   }else{
      $category->save();
      return Redirect::to('categorias')->with('notice', 'La categoria ha sido creada correctamente.');
   }
   }

   public function edit($id) { 
   $category = Category::find($id);
   return View::make('categorias.save')->with('category', $category);
   }

   public function update($id) { 
   $category = Category::find($id);
   $category->name = Input::get('name');
   $category->description = Input::get('description');
   $validator = Category::validate(Input::all(), $category->id);
   if($validator->fails()){
      $errors = $validator->messages()->all();
      return View::make('categorias.save')->with('category', $category)->with('errors', $errors);
   }else{
      $category->save();
      return Redirect::to('categorias')->with('notice', 'El usuario ha sido modificado correctamente.');
   }
   }

   public function destroy($id) { 
   $category = Category::find($id);
   $category->delete();
   return Redirect::to('categorias')->with('notice', 'La categoria ha sido eliminada correctamente.');
   }
 }
?>