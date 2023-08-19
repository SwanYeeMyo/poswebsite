@extends('Admin.dashboard')
@section('name','Product View Page')
@section('content')
<div class="container ">
    <div class="row ">
        <div class="col-lg-4 col-md-6 card">
            <form action="{{route('admin#ProductUpdate')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" disabled value="{{$product->product_id}}" name="product_id">
                <a href="{{route('admin#product')}}" class="my-2 btn btn-sm btn-dark">
                    <i class="fa-solid fa-chevron-left"></i></a>
                <div class="card p-3 border rounded mt-2">
                    <img src="{{ asset('storage/' . $product->image) }}" class="rounded img-card-top" alt="">
                </div>

        </div>

        <div class="col-lg-8 col-md-6 card">
            <div class="rounded card p-lg-3 p-md-5 p-2 ">
                <div class="form-group mb-3">
                    <label for="">Product Name</label>
                    <input type="text" disabled value="{{$product->name}}" name="productName" class="@error('productName')
                    is-invalid
                    @enderror form-control rounded fw-bold text-dark">
                    @error('productName')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <select name="category_id" disabled class="@error('category_id')
                                        @enderror   form-select  fw-bold form-select"
                        aria-label=".form-select-sm example">
                        @foreach ($categories as $c )
                        <option @if ($c->category_id == $product->category_id )
                            selected
                            @endif value="{{$c->category_id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Description</label>
                    <textarea name="description" disabled class=" fw-bold @error('description')
                                        is-invalid
                                        @enderror form-control" id="" cols="30" rows="10">
                        {{$product->description}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Price</label>
                    <input type="number" disabled value="{{$product->price}}" name="price" class="fw-bold @error('price')
                                                                                        is-invalid
                                                                                        @enderror form-control">
                    @error('price')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection