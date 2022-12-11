<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products=Product::all();
        $brands=Brand::all();
        $categories=Category::all();
        $customers=User::all();
        return view('backend.pages.dashboard', compact('products', 'brands', 'categories', 'customers'));
    }

    public function users()
    {
        $users= User::all();
        return view('backend.pages.users', compact('users'));
    }

    public function orderList()
    {
        $orders=Order::orderBy('id', 'desc')->get();
        return view('backend.pages.orders', compact('orders'));
    }

    public function orderDetails($bid, $oid)
    {
        $orderDetails= OrderDetails::where('order_id', $oid)->get();
        $billing=Billing::find($bid);

        return view('backend.pages.orderdetails', compact('orderDetails', 'billing'));
    }
}
