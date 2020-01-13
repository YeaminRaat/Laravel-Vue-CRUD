<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;

class ProductController extends Controller
{
    public function index(){
    	return view('welcome');
    }

    public function getProduct(){
        if (request()->ajax()) {
        	$product = Product::with('brand', 'category')
        						->orderBy('id', 'desc')
        						->paginate(5);

        	return response()->json($product);
        }
    }
    public function addProduct(Request $request){
    	//$product = new Product();
    	$this->validate($request, [
    		'title' => 'required|string|max:50',
    		'price' => 'required|numeric',
    	]);

    	$product = new Product();
    	$product->title = $request->title;
    	$product->category_id = $request->category_id;
    	$product->brand_id = $request->brand_id;
    	$product->price = $request->price;
    	$product->save();

    	return response()->json($request);
    }

    public function updateProduct(Request $request){
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'price' => 'required|numeric',
        ]);
        $product = Product::find($request->id);
        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->save();

        return response()->json($request);
    }

    public function deleteProduct(Request $request){
        $product = Product::find($request->id);
        if ($product){
            $product->delete();
        }
        return response()->json($product);
    }
}
