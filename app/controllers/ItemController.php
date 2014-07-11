<?php
 class ItemController extends BaseController {
    
  private $autorizado;
   public function __construct() {
      $this->autorizado = (Auth::check() and Auth::user()->name == 'Ariel');
   }
    
   public function index() {
    if(!$this->autorizado) return Redirect::to('/auth/login');
   $categories = Category::all(array('id','name'));
   return View::make('menuitem.index')->with('categories', $categories);
   }

   public function show($id) {
   if(!$this->autorizado) return Redirect::to('/auth/login'); 
   $itemmenu = Item::find($id);
   return View::make('menuitem.delete')->with('itemmenu', $itemmenu);
   }

   public function create() { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
   	$itemmenu = new Item();
    $categories = Category::all(array('id','name'));

   return View::make('menuitem.save', array('itemmenu' => $itemmenu, 'categories'=> $categories));
   }
   public function crear($id) { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
    $itemmenu = new Item();
    $itemcategory = Category::find($id);

   return View::make('menuitem.guardar', array('itemmenu' => $itemmenu, 'itemcategory'=> $itemcategory));
   }

   public function store() { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
    $itemmenu = new Item();
    $itemmenu->name = Input::get('name');
    $itemmenu->description = Input::get('description');
    $itemmenu->price = Input::get('price');
    $itemmenu->category_id = Input::get('category_id');
    $validator = Item::validate(Input::all());

    if ($validator->fails()){
         return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
          ));
            }
    else{   
        $itemmenu->save();
          return Response::json(array(
            'success'     =>  true
            ));
        }
   }

   public function edit($id) { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
   	$itemmenu = Item::find($id);
    $categories =Category::all(array('id','name'));
  return View::make('menuitem.save', array('itemmenu' => $itemmenu, 'categories'=> $categories));
   }

   public function update($id) { 
    if(!$this->autorizado) return Redirect::to('/auth/login');

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
    if(!$this->autorizado) return Redirect::to('/auth/login');
   $itemmenu = Item::find($id);
   $itemmenu->delete();
   return Redirect::to('items')->with('notice', 'El Item ha sido eliminado correctamente.');
   }
 }
?>