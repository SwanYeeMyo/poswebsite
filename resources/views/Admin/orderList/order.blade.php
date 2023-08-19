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
                            <th scope="col">ID</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Product_id</th>
                            <th scope="col">Total</th>

                        </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($data as $d )
                        <tr>
                            <th scope="row">{{$d->order_code}}</th>
                            <input type="hidden" value="{{ $d->id }}" class="orderId">
                            <td>{{$d->id}}</td>
                            <td>{{$d->user_id}}</td>
                            <td>{{$d->product_id}}</td>
                            <td>
                                <select name="status" id="" class="form-control statusChange border">
                                    <option value="0" @if ($d->status == 0) selected @endif>Pending</option>
                                    <option value="1" @if ($d->status == 1) selected @endif>Accept</option>
                                    <option value="2" @if ($d->status == 2) selected @endif>Reject</option>

                                </select>
                            </td>
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
<script>
    $(document).ready(function() {
        $('.statusChange').change(function() {
            $currentStatus = $(this).val();
            $parentNode = $(this).parents("tr");
            $orderId = $parentNode.find('.orderId').val();


            $data = {
                'status': $currentStatus,
                'orderId': $orderId,
            };
            console.log($data);
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/ajax/change/status',
                data: $data,
                dataType: 'json',

            });
        });
    });
</script>
@endsection

