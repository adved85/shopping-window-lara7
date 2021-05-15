@extends('layouts.app')
<style>
    .product-list-image {
        display: block;
        max-width:119px;
        max-height:175px;
        width: auto;
        height: auto;
        margin: auto;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('shared.alerts')

        <div class="col-md-12">

            <div class="card">
                <div class="card-header text-center">
                    <h6>{{ __('Orders Number') }} № {{$order->order_number}}</h6>
                    <small>Total: ${{$order->grand_total}} | Quantity: {{$order->item_count}}</small>

                </div>
                <div class="card-body">
                    {{-- @dump($order) --}}
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name/Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($order->orderItems as $key => $item)
                          <tr>
                            <th scope="row">{{++$key}}</th>
                            <td>
                                <img class="product-list-image"  src='{{$item->product->photo}}' alt='{{$item->product->name}}'>
                            </td>
                            <td>
                                <p>{{$item->product->name}}</p>
                                {{$item->product->description}}
                            </td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{($item->quantity*$item->price)}}</td>
                          </tr>
                          @empty
                          <tr class="text-center">
                            <th scope="row" colspan="6">There is no order yet.</th>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
