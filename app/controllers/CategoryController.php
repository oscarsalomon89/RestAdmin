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

   $validator = Category::validate(Input::all());
   if($validator->fails()){
   return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $category->name = Input::get('name');
      $category->description = Input::get('description');
      $category->save();
          return Response::json(array(
            'success'     =>  true
        ));
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
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }else{
      $category->save();
          return Response::json(array(
            'success'     =>  true,
            'types' => 'edit'
        ));
   }
   }

   public function destroy($id) { 
   $category = Category::find($id);
   $category->delete();
      return Response::json(array(
            'success'     =>  true
        ));
   }
 }
?>