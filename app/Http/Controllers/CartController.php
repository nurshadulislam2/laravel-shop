<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Order;
use App\Models\OrderDetails;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('frontend.pages.cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);


        return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );



        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);


        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();



        return redirect()->route('cart.list');
    }

    public function checkout($amount)
    {
        return view('frontend.pages.checkout', compact('amount'));
    }

    public function placeorder(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'mobile'=>'required',
            'address'=>'required'
        ]);

        $billing= Billing::create([
            'name'=> $request->name,
            'mobile'=> $request->mobile,
            'city'=> $request->city,
            'address'=> $request->address,
            'payment'=> $request->payment
        ]);

        $order= Order::create([
            'user_id'=> Auth::id(),
            'billing_id'=>$billing->id,
            'total'=> \Cart::getTotal()
        ]);

        $items= \Cart::getContent();

        foreach($items as $item){
            OrderDetails::create([
                'order_id'=>$order->id,
                'user_id'=>Auth::id(),
                'product_id'=>$item->id,
                'price'=>$item->price,
                'quantity'=> $item->quantity
            ]);
        }

        \Cart::clear();

        notify()->success('Your order place successfully!!!');

        return redirect()->route('/');

    }
}
