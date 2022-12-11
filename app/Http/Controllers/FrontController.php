<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function index()
    {
        $sliders=Slide::orderBy('id', 'desc')->limit(3)->get();
        $products=Product::orderBy('id', 'desc')->limit(9)->get();
        return view('frontend.pages.home', compact('products', 'sliders'));
    }

    public function product($id)
    {
        $product=Product::find($id);
        $products=Product::where('category_id', $product->category_id)->orderBy('id', 'desc')->limit(3)->get();

        return view('frontend.pages.product', compact('product', 'products'));
    }

    public function category($id)
    {
        $category=Category::find($id);
        $products=Product::where('category_id', $id)->orderBy('id', 'desc')->get();

        return view('frontend.pages.category', compact('products', 'category'));
    }
    public function brand($id)
    {
        $brand=Brand::find($id);
        $products=Product::where('brand_id', $id)->orderBy('id', 'desc')->get();

        return view('frontend.pages.brand', compact('products', 'brand'));
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%'. $request->search.'%')
        ->orWhere('description', 'like', '%'. $request->search. '%')->get();

        return view('frontend.pages.search', compact('products'));
    }

    public function profile()
    {
        return view('frontend.pages.profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'  =>  'required',
            'email' =>  'required',
            'mobile'=>  'required',
            'address'=> 'required',
        ]);

        $id= $request->id;
        $user= User::find($id);
        $user->name= $request->name;
        $user->email= $request->email;
        $user->mobile= $request->mobile;
        $user->address= $request->address;
        if($request->password){
            $user->password=Hash::make($request->password);
        }

        $user->save();
        notify()->success("User Updated");

        return redirect()->back();
    }

    public function orderDetails($id)
    {
        $orders=OrderDetails::where('user_id', $id)->orderBy('id', 'desc')->get();
        return view('frontend.pages.orderDetails', compact('orders'));
    }
}
