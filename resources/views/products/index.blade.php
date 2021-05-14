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
        <div class="col-md-12">

            <div class="card">
                <div class="card-header text-center">{{ __('Products') }}</div>
                <div class="card-body row">

                    @forelse ($products as $item)
                    <div class="card col-sm-3">
                        <img class="product-list-image"  src='{{$item->photo}}' alt='{{$item->name}}'>
                        <div class="card-body">
                            <h6 class="card-title">{{$item->name}}</h6>
                            <p class="card-text">{{ Str::limit($item->description, 60, '...') }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <p class="my-1"><strong>Price: </strong>{{$item->price}}$</p>
                            <a href='{{url("add-to-cart", $item->id)}}' class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>
                    @empty
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
