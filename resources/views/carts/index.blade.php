@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header text-center">{{ __('Cart') }}</div>
        <div class="card-body">
        <table id="cart" class="table table-hover table-condensed">
            <thead class="thead-dark">
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>

                @php
                    $total = \App\Models\Cart::getTotalCostAndQuantity()['total'];
                @endphp

                @if (session()->has('cart'))
                @foreach(session()->get('cart') as $id => $cartItem)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs">
                                    <img src='{{$cartItem['photo']}}' alt='{{$cartItem['name']}}' class="" width="90" height="120"/>
                                </div>
                                <div class="col-sm-9">
                                    <h4 class="m-0">{{$cartItem['name']}}</h4>
                                    <p>{{ Str::limit($cartItem['description'], 200, '...') }}</p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{$cartItem['price']}}</td>
                        <td data-th="Quantity">
                            <input type="number" class="form-control text-center quantity" value='{{$cartItem['quantity']}}' min="1">
                        </td>
                        <td data-th="Subtotal" class="text-center">${{$cartItem['price'] * $cartItem['quantity']}}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-info btn-sm update-cart" data-id='{{$id}}'><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id='{{$id}}'><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <a href="{{ url('/') }}" class="btn btn-warning">
                        <i class="fa fa-angle-left"></i>
                        Continue Shopping
                    </a>
                </td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total: ${{$total}}</strong></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="2">
                    <a href="{{ route('checkout.create') }}" class="btn btn-success">
                        Proceed To Checkout
                        <i class="fa fa-angle-right"></i>
                    </a>
                </td>
            </tr>
            </tfoot>
        </table>
        </div>
    </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        const updateCartUrl = @json(url('update-cart'));
        const removeFromCartUrl = @json(url('remove-from-cart'));
        const _token = @json(csrf_token());

        $('.update-cart').on('click', function(e) {
            e.preventDefault();
            const $productId = $(this).data('id');
            const $productQty = $(this).parents('tr').find('.quantity').val();

            $.ajax({
                url: updateCartUrl,
                method: 'PATCH',
                data: {_token: _token, id: $productId, quantity: $productQty}
            }).done(function(response) {
                alert(response.message);
                window.location.reload();
            }).fail(function( jqXHR, textStatus ) {
               alert( "Request failed: " + textStatus );
            });
        });

        $('.remove-from-cart').on('click', function(e) {
            e.preventDefault();
            const $productId = $(this).data('id');

            $.ajax({
                url: removeFromCartUrl,
                method: 'DELETE',
                data: {_token: _token, id: $productId}
            }).done(function(response) {
                alert(response.message);
                window.location.reload();
            }).fail(function( jqXHR, textStatus ) {
               alert( "Request failed: " + textStatus );
            });
        });

    </script>
@endsection
