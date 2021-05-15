@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('shared.alerts')

        <div class="col-md-12">

            <div class="card">
                <div class="card-header text-center">{{ __('Orders') }}</div>
                <div class="card-body">
                    {{-- @dump($orders) --}}
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Total</th>
                            <th scope="col">Q-ty</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($orders as $key => $item)
                          <tr>
                            <th scope="row">{{++$key}}</th>
                            <td>{{$item->order_number}}</td>
                            <td>$ {{$item->grand_total}}</td>
                            <td>{{$item->item_count}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                                <a class="btn btn-primary" href='{{route('orders.show', $item)}}'>
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
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
