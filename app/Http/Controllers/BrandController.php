<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;

class BrandController extends Controller
{
	public function getBrand(){
        if (request()->ajax()) {
    		$brand = Brand::orderBy('id', 'desc')->get();

    		return response()->json($brand);
        }
	}
    
    public function addBrand(Request $request){
    	$this->validate($request, [
    		'name' => 'required|unique:brands,name'
    	]);

    	$brand = new Brand();
    	$brand->name = $request->name;
    	$brand->save();

    	return response()->json($request);
    }
}
