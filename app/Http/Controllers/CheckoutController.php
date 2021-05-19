<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Cart, Order};


class CheckoutController extends Controller
{
    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checkout.create');
    }

    /**
     * Store a newly created order with his items in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'post_code' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'notes' => 'nullable|string'
        ]);

        $cart = Cart::getCartContent();
        $totalCostAndQuantity = Cart::getTotalCostAndQuantity();

        $orderData = $request->all();
        $orderData['user_id'] = auth()->id();
        $orderData['order_number'] = 'ORD-' . strtoupper(uniqid());
        $orderData['grand_total'] = $totalCostAndQuantity['total'];
        $orderData['item_count'] = $totalCostAndQuantity['quantity'];
        $orderData['status'] = 'pending';

        $order = Order::create($orderData);
        if ($order && !empty($cart)) {
            foreach ($cart as $key => $item) {

                $order->orderItems()->create([
                    'product_id' => $key,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }
        }

        session()->forget('cart');
        return redirect()->route('orders.index')->with(['successMessage'=>'Order created successfully']);
    }
}
