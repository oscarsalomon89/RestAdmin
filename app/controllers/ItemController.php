<?php
 class ItemController extends BaseController {
    
   public function index() {
   $categories = Category::all(array('id','name'));
   return View::make('menuitem.index')->with('categories', $categories);
   }

   public function show($id) { 
   $itemmenu = Item::find($id);
   return View::make('menuitem.delete')->with('itemmenu', $itemmenu);
   }

   public function create() { 
   	$itemmenu = new Item();
    $categories = Category::all(array('id','name'));

   return View::make('menuitem.save', array('itemmenu' => $itemmenu, 'categories'=> $categories));
   }
   public function crear($id) { 
    $itemmenu = new Item();
    $itemcategory = Category::find($id);

   return View::make('menuitem.guardar', array('itemmenu' => $itemmenu, 'itemcategory'=> $itemcategory));
   }

   public function store() { 
    $itemmenu = new Item();
    $input = Input::get();

    $validator = Item::validate($input);

    if ($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
          ));
            }
    else{
        $itemmenu->name = $input['name'];
        $itemmenu->description = $input['description'];
        $itemmenu->price = $input['price'];
        $itemmenu->category_id = $input['category_id'];   
        $itemmenu->save();
          return Response::json(array(
            'success'     =>  true
            ));
        }
   }

   public function edit($id) { 
   	$itemmenu = Item::find($id);
    $categories =Category::all(array('id','name'));
  return View::make('menuitem.save', array('itemmenu' => $itemmenu, 'categories'=> $categories));
   }

   public function update($id) { 

        $itemmenu = Item::find($id);
        $itemmenu->name = Input::get('name');
        $itemmenu->description = Input::get('description');
        $itemmenu->price = Input::get('price');
        $itemmenu->category_id = Input::get('category_id');

        $validator = Item::validate(Input::all(), $itemmenu->id);
        if ($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
          ));
        }else{
        $itemmenu->save();
        return Response::json(array(
            'success'     =>  true,
            'types' => 'edit'
        ));
        }
   }

   public function destroy($id) { 
   $itemmenu = Item::find($id);
   $itemmenu->delete();
   return Redirect::to('items')->with('notice', 'El Item ha sido eliminado correctamente.');
   }
 }
?>