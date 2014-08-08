<?php
 class StatisticsController extends BaseController {

public function index() {
   $categories = DB::table('categories')->orderBy('name', 'asc')->get();
   //$items = DB::table('items')->groupBy('category_id')->orderBy('name', 'asc')->get();
   return Response::json($categories);
   }

}