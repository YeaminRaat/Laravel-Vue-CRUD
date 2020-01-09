<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;

class CategoryController extends Controller
{
	public function getCategory(){
        if (request()->ajax()) {
    		$category = Category::orderBy('id', 'desc')->get();

    		return response()->json($category);
        }
	}
    
    public function addCategory(Request $request){
    	$this->validate($request, [
    		'name' => 'required|unique:categories,name'
    	]);

    	$category = new Category();
    	$category->name = $request->name;
    	$category->save();

    	return response()->json($request);
    }
}
