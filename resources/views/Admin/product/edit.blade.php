@extends('Admin.dashboard')
@section('name','Product Edit Page')
@section('content')
<div class="container ">
    <div class="row ">
        <div class="col-lg-4 col-md-6 card">
            <form action="{{route('admin#ProductUpdate')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$product->id}}" name="product_id">
                <a href="{{route('admin#product')}}" class="my-2 btn btn-sm btn-dark">
                    <i class="fa-solid fa-chevron-left"></i></a>
                <div class="card p-3  rounded mt-2">
                    <h6>{{$product->created_at->format('d/m/y')}}</h6>
                    <img src="{{ asset('storage/' . $product->image) }}" class="rounded img-card-top" alt="">
                </div>
                <div class="form-group mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image"
                        class="@error('image')
                                                                                                is-invalid
                                                                                                @enderror form-control">
                    @error('image')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>

                    @enderror
                </div>

        </div>

        <div class="col-lg-8 col-md-6 card">
            <div class="rounded card p-lg-3 p-md-5 p-2 ">
                <div class="form-group mb-3">
                    <label for="">Product Name</label>
                    <input type="text" value="{{$product->name}}" name="productName" class="@error('productName')
                    is-invalid
                    @enderror form-control rounded">
                    @error('productName')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <select name="category_id" class="@error('category_id')
                                        @enderror  form-select form-select" aria-label=".form-select-sm example">
                        @foreach ($categories as $c )
                        <option @if ($c->id == $product->category_id )
                            selected
                            @endif value="{{$c->id}}">{{$c->name}}</option>
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
                    <textarea name="description" class="@error('description')
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
                    <input type="number" value="{{$product->price}}" name="price" class="@error('price')
                                                                                        is-invalid
                                                                                        @enderror form-control">
                    @error('price')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Update
                    </button>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection