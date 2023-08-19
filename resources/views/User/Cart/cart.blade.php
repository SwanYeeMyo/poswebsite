@extends('layouts.user.master')
@section('content')
<div class="container">
    <div class="my-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a  href="{{route('user#home')}}">Home</a></li>
              <li class="breadcrumb-item"><a  href="{{route('user#products')}}">Products</a></li>
              <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
          </nav>
    </div>
    <div class="row mt-5 ">
        <div class="col-lg-8">
            <table class="table align-middle mb-0 bg-white" id="dataTable">
                <thead class="bg-light">
                  <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $c )
                    <tr>
                        <input type="hidden" class="orderId" value="{{$c->id}}">
                        <input type="hidden" class="productId" value="{{$c->product_id}}">
                        <input type="hidden" class="userId" value="{{Auth::user()->id}}">
                        <td>
                          <div class="d-flex align-items-center">
                            <img
                            src="{{ asset('storage/' . $c->getProduct->image) }}"
                                alt=""
                                style="width: 45px; height: 45px"
                                class="rounded-circle"
                                />
                            <div class="ms-3">
                              <p class="fw-bold mb-1">{{Auth::user()->name}}</p>
                              <p class="text-muted mb-0">{{$c->getProduct->name}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                            <input type="hidden" id="qty" value="{{$c->qty}}">
                            <h6 >{{$c->qty}} x {{$c->getProduct->price}} Kyats</h6>
                        </td>
                        <td>
                            <input type="hidden" value="{{$c->total}}" id="total">
                          <span class="text-light badge badge-dark rounded-pill d-inline">{{$c->total}}</span>
                        </td>

                        <td>
                          <a href="{{route('user#cartDelete', $c->id)}}" id="removeBtn" type="button" class="btn btn-danger btn-sm btn-rounded">
                            <i class="fa-solid fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="col-lg-4">
            <div class="card ">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    Delete
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
                <div class="card-header">
                    <h6>Check Out</h6>
                </div>
                <div class="card-body ">
                   <div class="row g-2 ">
                   @foreach ($carts as $c )
                    <div class="col-6 ">
                        <span>{{$c->getProduct->name}}</span>
                    </div>
                    <div class="col-3 offset-3">
                        <span class="text-light badge badge-dark rounded-pill d-inline">{{$c->total}} Kyats</span>
                    </div>
                   @endforeach
                   </div>
                    <div class="d-flex justify-content-between my-3">
                        <div>
                            DeliFees
                        </div>
                        <div>
                           <b>3000 kyats</b>
                        </div>
                    </div>
                    <hr>
                    @if (count($carts) )
                    <div class="row g-2">
                        <div class="col-6 ">
                            <span>Total</span>
                        </div>
                        <div class="col-3 offset-3">
                            <span class="text-dark p-2 badge badge-success rounded-pill d-inline"> {{ $Total }} Kyats</span>
                        </div>
                    </div>
                    @endif

                    <div class="card-footer my-2">
                        <button type="button" @if (count($carts) == 0) disabled @endif
                            class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed
                            To
                            Checkout</button>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $('#orderBtn').click(function(){
        $orderList = [];
        $random = Math.floor(Math.random() * 10001);
        $('#dataTable tbody tr').each(function(index,row){
            $orderList.push({
                'user_id' : $(row).find('.userId').val(),
                'product_id' : $(row).find('.productId').val(),
                'qty' : $(row).find('#qty').val(),
                'total' : $(row).find('#total').val(),
                'order_code' : 'POS' + $random,
            });
        });
        $.ajax({
            type : 'get',
            url : 'http://127.0.0.1:8000/ajax/order',
            data : Object.assign({},$orderList),
            dataType : 'json',
            success : function(response){
                console.log('success');
                window.location.href = 'http://127.0.0.1:8000/user/products';
            }
        })


    });
</script>


@endsection
