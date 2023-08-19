@extends('Admin.dashboard')
@section('name','Order List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <form action="">
                @csrf
                <div class="d-flex">
                <input type="text" value="{{request('key')}}" name="key" class="form-control">
                    <button class="mx-2 btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-12 col-md-12 col-12">
            @if (request('key'))
            <a href="{{route('admin#orderList')}}">
                <button class="btn btn-dark my-2">Back</button>
            </a>
            @endif
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Order_code</th>
                        <th scope="col">User_id</th>
                        <th scope="col">Product_id</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d )
                        <tr>
                            <th scope="row">{{$d->order_code}}</th>
                            <td>{{$d->user_id}}</td>
                            <td>{{$d->product_id}}</td>
                            <td>{{$d->qty}}</td>
                            <td>{{$d->total}}</td>
                            <td>{{$d->created_at->format('d/m/y')}}</td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{$data->links()}}
            </div>


        </div>

    </div>
</div>
@endsection
