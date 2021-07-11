<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
  public function list()
  {
    $categoriesList = Category::all();

    return response()->json( $categoriesList, 200 );
  }

  public function add()
  {
    $category = new Category();

    $category->title = $_POST['title'];

    $category->save();
  }

  public function edit()
  {

  }

  public function delete( $id )
  {
    $category = Category::find( $id );
    $category->delete();

    return response()->json( null, 204 );
  }
}
