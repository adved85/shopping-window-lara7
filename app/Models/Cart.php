<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    static public function getTotalCostAndQuantity():array
    {
        $total = 0;
        $quantity = 0;
        if(session()->has('cart')) {
            foreach (session()->get('cart') as  $cartItem) {
                $subTotal = $cartItem['price'] * $cartItem['quantity'];
                $total += $subTotal;
                $quantity += $cartItem['quantity'];
            }
        }
        return compact('total', 'quantity');
    }

    static public function getCartContent():array
    {
        return (session()->has('cart')) ? session()->get('cart') : [];
    }
}
