@extends('layouts.app')

@section('content')
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-th="Product">
                <div class="row">
                    <div class="col-sm-3 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                    <div class="col-sm-9">
                        <h4 class="nomargin">Product 1</h4>
                        <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </td>
            <td data-th="Price">$1.99</td>
            <td data-th="Quantity">
                <input type="number" class="form-control text-center" value="1">
            </td>
            <td data-th="Subtotal" class="text-center">1.99</td>
            <td class="actions" data-th="">
                <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>

            @php
                $total = 0;
            @endphp

            @if (session()->has('cart'))
            @foreach(session()->get('cart') as $cartItem)
            @php
                $subTotal = $cartItem['price'] * $cartItem['quantity'];
                $total += $subTotal;
            @endphp
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src='{{$cartItem['photo']}}' alt='{{$cartItem['name']}}' class="" width="100" height="120"/>
                            </div>
                            <div class="col-sm-9">
                                <h4 class="m-0">{{$cartItem['name']}}</h4>
                                <p>'{{ Str::limit($cartItem['description'], 200, '...') }}'</p>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{$cartItem['price']}}</td>
                    <td data-th="Quantity">
                        <input type="number" class="form-control text-center" value='{{$cartItem['quantity']}}' min="0">
                    </td>
                    <td data-th="Subtotal" class="text-center">${{$subTotal}}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total {{$total}}</strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total ${{$total}}</strong></td>
        </tr>
        </tfoot>
    </table>
@endsection
