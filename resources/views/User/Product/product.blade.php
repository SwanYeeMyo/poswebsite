@extends('layouts.user.master')
@section('content')
<div class="container">

</div>
<div class="container-fluid my-lg-5 my-md-5">

    <div class="row">
        <div class="col-lg-2">
            <ol class="card p-3 list-group list-group-light list-group-numbered">
                <div class="my-2 d-felx justify-content-between">
                    <button type="button" class="btn btn-primary">
                        Categories <span class="badge badge-danger ms-2">{{count($categories)}}</span>
                    </button>
                    @if (Auth::user())
                    @if (count($carts))
                    <a href="{{route('user#cart')}}" class=" float-end my-2">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">{{count($carts)}}</span>
                    </a>
                    @endif
                    @else
                    <a href="" class=" float-end my-2">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">0</span>
                    </a>
                    @endif

                </div>

                @foreach ($categories as $c )
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"></div>
                        <a href="{{route('user#filter',$c->id)}}" class="text-dark">
                            {{$c->name}}
                        </a>

                    </div>
                    <span class="badge badge-primary rounded-pill">
                        {{$c->products_count}}
                    </span>
                </li>
                @endforeach

            </ol>
        </div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="my-lg-0 my-lg-md-0 order-last my-3">
                        <select name="sorting" id="sortingOption" class="form-select   form-select-sm"
                            aria-label="Default select example">

                            <option selected value="asc">Asending</option>
                            <option value="desc">Desending</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-0"></div>
                <div class="col-lg-4 col-12  order-1">
                    <div class="form-group my-lg-0 my-lg-md-0 my-3">
                        <form action="" method="GET">
                            @csrf
                            <div class="d-flex">
                                <input name="key" value="{{request('key')}}" type="search" id="form1"
                                    class="form-control" />
                                <button type="submit" class=" mx-1 btn btn-light rounded">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="row" id="dataList">
                @if (count($products))
                @if (request('key'))
                <div>
                    <a href="{{route('user#products')}}" class="btn btn-dark btn-sm">
                        <i class="fa-solid fa-backward"></i>
                    </a>
                </div>
                @endif
                @foreach ($products as $p )
                <div class="col-lg-3 col-md-6 col-12 g-3">
                    <div class="card   text-black">
                        <div class="bg-image hover-zoom  ">
                            <img src="{{ asset('storage/' . $p->image) }}"  class="card-img-top  "
                               alt="Apple Computer" />
                        </div>
                        <div class="card-body">
                            <div class="text-left">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">{{$p->name}}</h6>
                                    </div>
                                    <div>
                                        <h6 class=" mb-4">{{$p->category->name}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-4">{{$p->price}} Kyats</h6>
                                    </div>
                                    <div class="">
                                        <span class="text-warning">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star-half-stroke"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div>

                                <div class=" ">
                                    <form action="{{route('user#viewProduct')}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$p->id}}" name="id">
                                                <button class="btn btn-dark">View Item</button>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="mt-5 p-3 rounded  ">
                    <a href="{{route('user#products')}}" class=" btn btn-dark btn-sm">
                        <i class="fa-solid fa-backward"></i>
                    </a>

                </div>
                @endif

                <div class="my-3 " id="link">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#sortingOption').change(function(){
            $eventOption = $(this).val();
            $url = "{{route('user#viewProduct')}}";
            if($eventOption == 'asc'){
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/ajax/products',
                    data : {'status' : 'asc'},
                    dataType : 'json',
                    success : function(data){
                        console.log(data[0].category['name']);

                        $list = '';
                        for (let i = 0; i < data.length; i++) {
                           $list +=
                                        `
            <div class="col-lg-3 col-md-6 col-12 g-3">
            <div class="card  text-black">
                        <div class="bg-image hover-zoom  rounded">
                            <img src="{{ asset('storage/${data[i].image}') }}" class="card-img-top rounded"
                            style="border-radius: 50px"  alt="Apple Computer" />
                        </div>
                        <div class="card-body">
                            <div class="text-left">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">${data[i].name}</h6>
                                    </div>
                                    <div>
                                        <h6 class=" mb-4">${data[i].category['name']}</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-4">${data[i].price} Kyats</h6>
                                    </div>
                                    <div class="">
                                        <span class="text-warning">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star-half-stroke"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div>

                                <div class=" my-3">
                                 <form action="${$url}" method="POST">
                                    @csrf
                               <input type="hidden" value="${data[i].id}" name="id">
                                    <button class="btn btn-dark">View Item</button>
                                </form>
                                </div>

                            </div>

                        </div>
                    </div>
                        </div>`;
                        }
                        $('#dataList').html($list);
                    }
                })
            }else{
               $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/ajax/products',
                data : {'status' : 'desc'},
                dataType : 'json',
                success : function(data){
                    console.log(data[0].id);
                    $list = '';
                        for (let i = 0; i < data.length; i++) { $list +=` <div class="col-lg-3 col-md-6 col-12 g-3">
                            <div class="card  text-black">
                                <div class="bg-image hover-zoom  rounded">
                                    <img src="{{ asset('storage/${data[i].image}') }}" class="card-img-top rounded" alt="Apple Computer" />
                                </div>
                                <div class="card-body">
                                    <div class="text-left">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">${data[i].name}</h6>
                                    </div>
                                    <div>
                                        <h6 class=" mb-4">${data[i].category['name']}</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-4">${data[i].price} Kyats</h6>
                                    </div>
                                    <div class="">
                                        <span class="text-warning">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star-half-stroke"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                                    <div>

                                        <div class=" my-3">
                                            <form action="${$url}" method="POST">
                                                @csrf
                                                <input type="hidden" value="${data[i].id}" name="id">
                                                <button class="btn btn-dark">View Item</button>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            </div>`;
                            }
                            $('#dataList').html($list);
                }
                })
            }
        })
    //    $.ajax({
    //     type : 'get',
    //     url : 'http://127.0.0.1:8000/ajax/products',
    //     dataType : 'json',
    //     success : function(response){
    //         console.log(response);
    //     }
    //    })
        $sortingOption = $('#sortingOption').val();
        console.log($sortingOption);
    })
</script>
@endsection
