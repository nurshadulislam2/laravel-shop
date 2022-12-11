<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('backend.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.pages.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          =>  'required',
            'image'         =>  'required | mimes:jpg,png',
            'price'         =>  'required',
            'category'      =>  'required',
            'brand'         =>  'required',
            'description'   =>  'required'
        ]);

        $image = $request->file('image');
        $imageName = time() . $image->getClientOriginalName();
        $image->move('images/product/', $imageName);

        Product::create([
            'name'          =>  $request->name,
            'image'         =>  $imageName,
            'price'         =>  $request->price,
            'category_id'   =>  $request->category,
            'brand_id'      =>  $request->brand,
            'description'   =>  $request->description
        ]);

        notify()->success('Product Created Successfully!!!');
        return redirect()->route('admin.product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('backend.pages.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          =>  'required',
            'price'         =>  'required',
            'category'      =>  'required',
            'brand'         =>  'required',
            'description'   =>  'required'
        ]);

        $product = Product::find($id);

        if ($request->file('image')) {
            unlink('images/product/'. $product->image);
            $image = $request->file('image');
            $imageName = time() . $image->getClientOriginalName();
            $image->move('images/product/', $imageName);
            $product->image=$imageName;
        }

        $product->name=$request->name;
        $product->price=$request->price;
        $product->category_id=$request->category;
        $product->brand_id=$request->brand;
        $product->description=$request->description;
        $product->save();

        notify()->success('Product Updated Successfully!!!');

        return redirect()->route('admin.product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        unlink('images/product/'. $product->image);
        $product->delete();

        notify()->success('Product Deleted Successfully!!!');

        return redirect()->route('admin.product');
    }
}
