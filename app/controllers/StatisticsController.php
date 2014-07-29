<?php
 class StatisticsController extends BaseController {

public function index() {
   $categories = Category::findOrFail(1);
   return Response::json($categories);
   }

}