<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){

            return view('dashboard.dashboard');

    }


    public function front_index(Request $request){
        $products=\App\Models\Product::all();
        return view('front.index',compact('products'));

    }

    public function single_product($id)
    {
        $product=Product::find($id);
        $product_attribute_id=ProductAttribute::where('product_id',$product->id)->pluck('attribute_id')->toArray();
        $attributes=Attribute::whereIn('id',$product_attribute_id)->get();

        return view('front.single_product',compact('product','attributes'));

    }
    public  function save_order (Request $request){


        $product=Product::find($request->product_id);
        $total=$request->total ==0?$product->price:$request->total;
       $order= Order::create([
            'product_id'=>$request->product_id,
            'total'=>$total,
            'color_product_id'=>$request->color_product_id,
            'size_product_id'=>$request->size_product_id,
            'amount_product_id'=>$request->amount_product_id,

        ]);


        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$order
        ]);

    }



}
