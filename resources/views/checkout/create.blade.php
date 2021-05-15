@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('checkout.store') }}">
    @csrf
    <div class="row justify-content-center">

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">{{ __('Billing Details') }}</div>

                    <div class="card-body">

                        <!-- first and last names -->
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="first_name" class="col-form-label text-md-right">{{ __('First Name') }}</label>
                                <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" required autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label for="last_name" class="col-form-label text-md-right">{{ __('Last Name') }}</label>
                                <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" required autocomplete="last_name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- address -->
                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label text-md-left">{{ __('Address') }}</label>
                            <div class="col-md-10">
                                <input id="address" type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" required autocomplete="address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- city and county -->
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="city" class="col-form-label text-md-right">{{ __('City') }}</label>
                                <input id="city" type="text" name="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" required autocomplete="city">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label for="country" class="col-form-label text-md-right">{{ __('Country') }}</label>
                                <input id="country" type="text" name="country" value="{{ old('country') }}" class="form-control @error('country') is-invalid @enderror" required autocomplete="country">
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- post_code and phone_number -->
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="post_code" class="col-form-label text-md-right">{{ __('Post Code') }}</label>
                                <input id="post_code" type="text" name="post_code" value="{{ old('post_code') }}" class="form-control @error('post_code') is-invalid @enderror" required autocomplete="post_code">
                                @error('post_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label for="phone_number" class="col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" required autocomplete="phone_number">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- email address -->
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('Email') }}</label>
                            <div class="col-md-10">
                                <input id="email" type="text" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control @error('email') is-invalid @enderror" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- notes -->
                        <div class="form-group row">
                            <label for="notes" class="col-md-2 col-form-label text-md-left">{{ __('Order Notes') }}</label>
                            <div class="col-md-10">
                                <textarea id="notes" name="notes" cols="30" rows="4" class="form-control @error('notes') is-invalid @enderror" required>{{ old('notes') }}</textarea>
                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{ __('Your Order') }}</div>

                    <div class="card-body">
                        @php
                            $total = \App\Models\Cart::getTotalCostAndQuantity()['total'];
                            $quantity = \App\Models\Cart::getTotalCostAndQuantity()['quantity'];
                        @endphp
                        <dl class="d-flex justify-content-between">
                            <dt>Total cost:</dt>
                            <dd>$ {{$total}}</dd>
                        </dl>
                        <dl class="d-flex justify-content-between">
                            <dt>Item count:</dt>
                            <dd>{{$quantity}}</dd>
                        </dl>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                @if (!$total)
                                    <a href="{{url('/')}}" class="btn btn-primary disabled">{{ __('Place Order') }}</a>
                                @else
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Place Order') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    </form>
</div>
@endsection
