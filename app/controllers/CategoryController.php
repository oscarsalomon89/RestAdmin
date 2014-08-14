<?php
 class CategoryController extends BaseController {
    
   public function index() {

   $categories = Category::all();
   if (Request::wantsJson())
    {
      return Response::json($categories);
    }else{
      return View::make('categorias.index', array('categories' => $categories));
    }
   }

   public function show($id) { 
   $category = Category::find($id);
   return View::make('categorias.delete')->with('category', $category);
   }
   public function create() { 
   $category = new Category();
   return View::make('categorias.save', array('category' => $category));
   }

   public function store() { 
   
   $input = Input::get();
   $validator = Category::validate($input);

   if($validator->fails()){
   return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }
      $category = new Category();
      $category->name = $input['name'];
      $category->description = $input['description'];
      $category->save();
          return Response::json(array(
            'success'     =>  true
        ));
   }

   public function edit($id) { 
   $category = Category::find($id);
   return View::make('categorias.save', array('category' => $category));
   }

   public function update($id) { 

    $input = Input::get();
    $category = Category::find($id);
    $validator = Category::validate($input, $category->id);
    
   if($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
      ));
   }
    $category->name = $input['name'];
    $category->description = $input['description'];
    $category->save();
          return Response::json(array(
            'success'     =>  true,
            'types' => 'edit'
        ));
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