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
    $itemcategories = Category::all();

   return View::make('menuitem.save', array('itemmenu' => $itemmenu, 'itemcategories'=> $itemcategories));
   }
   public function crear($id) { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
    $itemmenu = new Item();
    $itemcategory = Category::find($id);

   return View::make('menuitem.guardar', array('itemmenu' => $itemmenu, 'itemcategory'=> $itemcategory));
   }

   public function store() { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
    $respuesta = array();
 
        $reglas =  array(
            'name'  => 'required',
            'description'  => array('required', 'min:10'),  
            'price' => array('required', 'numeric'), 
            'category_id'=>'required'
        );
    $input=Input::all();
    $validator = Validator::make($input, $reglas);
    if ($validator->fails()){
            $respuesta['notice'] = $validator;
            $respuesta['error']   = true;
            }
    else{
            $itemmenu = new Item();
            $itemmenu->name = Input::get('name');
            $itemmenu->description = Input::get('description');
            $itemmenu->price = Input::get('price');
            $itemmenu->category_id = Input::get('category_id');
            $itemmenu->save();
                               
            $respuesta['notice'] = 'Producto creado!';
            $respuesta['error']   = false;
            $respuesta['data']    = $itemmenu;
        }
        if ($respuesta['error'] == true){
            return Redirect::to('items/create')->withErrors($respuesta['notice'] )->withInput();
        }else{
            return Redirect::to('items')->with('notice', $respuesta['notice']);
        }
   }

   public function edit($id) { 
    if(!$this->autorizado) return Redirect::to('/auth/login');
   	$itemmenu = Item::find($id);
    $itemcategories =Category::all();
  return View::make('menuitem.save', array('itemmenu' => $itemmenu, 'itemcategories'=> $itemcategories));
   }

   public function update($id) { 
    if(!$this->autorizado) return Redirect::to('/auth/login');

        $itemmenu = Item::find($id);
        $itemmenu->name = Input::get('name');
        $itemmenu->description = Input::get('description');
        $itemmenu->price = Input::get('price');
        $itemmenu->category_id = Input::get('category_id');
        $respuesta = array();
 
        $reglas =  array(
            'name'  => 'required',
            'description'  => array('required', 'min:10'),  
            'price' => array('required', 'numeric'), 
            'category_id'=>'required',
        );
        $input=Input::all();
        $validator = Validator::make($input, $reglas);
        
        if ($validator->fails()){
            $respuesta['notice'] = $validator;
            $respuesta['error']   = true;
        }else{
            $itemmenu->save();                               
            $respuesta['notice'] = 'Producto modificado!';
            $respuesta['error']   = false;
            $respuesta['data']    = $itemmenu;
        }
        
        if ($respuesta['error'] == true){
            return Redirect::to('items/'.$id.'/edit')->withErrors($respuesta['notice'] )->withInput();
        }else{
            return Redirect::to('items')->with('notice', $respuesta['notice']);
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