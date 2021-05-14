<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carts.index');
    }

    /**
     * Adding item to cart.
     *
     * @param  int  $id
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart');

        // dump($product->attributes);
        // dump($cart);

        if (!session()->has('cart')) {

            $cartWithFirstItem = [$id => array_merge($product->toArray(), ['quantity' => 1])];
            session()->put('cart', $cartWithFirstItem);
            return redirect()->back()->with('success', 'First Product added to cart successfully!');
        }

        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Same Product added to cart successfully!');
        } else {
            $cart[$id] = array_merge($product->toArray(), ['quantity' => 1]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'New Product added to cart successfully!');
        }
    }


    /**
     * Update item of cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request)
    {
        if ($request->filled('id') && $request->filled('quantity')) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            // session()->flash('success', 'Cart updated successfully');
            return response()->json(['message' => 'Cart updated successfully'], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Remove item from cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(Request $request)
    {
        if ($request->filled('id')) {
            $cart = session()->get('cart');
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            // session()->flash('success', 'Product removed successfully');
            return response()->json(['message' => 'Product removed successfully'], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
    }
}
