@extends('layouts.user.master')
@section('content')
<div class="container">
    <div class="row mt-lg-5 mt-md-5">
        <div class="col-lg-6">
            <a href="{{route('user#products')}}">
                <button class="btn btn-primary">Back</button>
            </a>
            <div class="card my-2">
                <img src="{{ asset('storage/' . $product->image) }}" class="  card-img-top" alt="">
            </div>
        </div>
        <div class="col-lg-5 offset-lg-1">
            <div class="p-3  ">
                <h2>{{$product->name}}</h1>
                    <span class="d-block my-2">{{$product->category->name}}</span><br>
                    <h3 for="">Description</h3>
                    <p class="fs-5">{{$product->description}}</p>
                    <h6 class="text-secondary my-1">Price : {{$product->price}}</h6>
                    <h5>{{$product->rating}}</h5>
                    <span class="text-warning">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star-half-stroke"></i>
                    </span>
                    @if (!Auth::user())
                    <button class="btn btn-warning disable my-2">
                        Please Login To Add To Cart
                    </button>
                    @else
                    <div class="my-lg-3 my-md-3 my-3 ">

                        <input type="text" class="form-control-sm" value="1" id="count">
                        <button id="btnMinus" class="btn btn-sm btn-light btn-rounded">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <button id="btnPlus" class="btn btn-sm btn-rounded btn-light">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                    <button id="addToCart" class="mx-2  btn btn-dark my-3">
                        Add To Cart
                    </button>

                    @endif
                    {{-- get The data with the Jquery --}}
                    @if (Auth::user())
                    <input type="hidden" value="{{Auth::user()->id}}" id="userId">
                    <input type="hidden" value="{{$product->price}}" id="price">
                    @endif
                    <input type="hidden" value="{{$product->id}}" id="productId">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var count = $('#count');
        var plusButton = $('#btnPlus');
        var minusButton = $('#btnMinus');

        // Plus button click event
        plusButton.click(function() {
        var currentValue = parseInt(count.val(), 10);
        count.val(currentValue + 1);
        });

        // Minus button click event
        minusButton.click(function() {
        var currentValue = parseInt(count.val(), 10);
        if (currentValue > 1) {
        count.val(currentValue - 1);
        }
        });

        $("#addToCart").click(function(){
            $userId = $('#userId').val();
            $productId = $('#productId').val();
            $price = $('#price').val();
            $count = $("#count").val();
            $source = {
                'user_id' : $userId,
                'product_id' : $productId,
                'qty' : $count,
                'price' : $price
            }
            // console.log($source);
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/ajax/addtocart',
                data : $source,
                dataType : 'json',
                success : function(response){
                   if(response.status == 'success'){
                   window.location.href = 'http://127.0.0.1:8000/user/products';
                   }
                }
            })
        });



    });
</script>
@endsection
