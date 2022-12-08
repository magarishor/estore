<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    public function index(Request $request)
    {
        $cart = [];

        if($request->hasCookie('estore_cart')){
            $cart = json_decode($request->cookie('estore_cart'), true);
        }

        foreach ($cart as $id => $data){
            $cart[$id]['product'] = Product::find($id);
        }

        $cart = collect($cart);

        return view('front.cart.index', compact('cart'));
    }

    public function store( Request $request, Product $product, $qty = 1)
    {
        $cart = [];

        if($request->hasCookie('estore_cart')){
            $cart = json_decode($request->cookie('estore_cart'), true);
        }

        $price = $product->price;

        if(key_exists($product->id, $cart)){
            $qty += $cart[$product->id]['qty'];
        }

        $cart[$product->id] = [
          'price' => $price,
          'qty' => $qty,
          'total' => $qty * $price
        ];

        flash('Product added to cart.')->success();

        return response()->json(['message' => 'ok'])->cookie('estore_cart', json_encode($cart), 30*24*60);
    }

    public function update(Request $request)
    {
        $cart = json_decode($request->cookie('estore_cart'), true);
        foreach ($request->qty as $id => $item){
            $cart[$id]['qty'] = $item;
            $cart[$id]['total'] = $item * $cart[$id]['price'];
        }
        flash('Cart Updated.')->success();

        return redirect()->route('front.cart.index')->cookie('estore_cart', json_encode($cart), 30*24*60);
    }

    public function destroy(Request $request, $id)
    {
        $cart = json_decode($request->cookie('estore_cart'), true);
        unset($cart[$id]);
        if(!empty($cart)){
            flash('Product removed from cart.')->success();
            return redirect()->route('front.cart.index')->cookie('estore_cart', json_encode($cart), 30*24*60);
        }else{
            flash('Cart is empty.')->success();
            return redirect()->route('front.cart.index')->withoutCookie('estore_cart');

        }
    }

    public function checkout(Request $request)
    {
        $cart = json_decode($request->cookie('estore_cart'), true);
        $order = Order::create([
         'user_id' => Auth::id(),
         'status' => 'Processing'
        ]);

        foreach ($cart as $id => $item){
            OrderDetail::create([
               'product_id' => $id,
               'order_id' => $order->id,
                'rate' => $item['price'],
                'qty' => $item['qty'],
                'total' => $item['total'],
            ]);
        }

        flash('Thank you for your order.')->success();
        return redirect()->route('front.user.index')->withoutCookie('estore_cart');
    }

}
