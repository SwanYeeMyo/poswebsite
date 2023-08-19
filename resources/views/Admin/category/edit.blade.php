@extends('Admin.dashboard')
@section('name','Category')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-12"></div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow rounded p-3">
                <form action="{{route('category#update')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$category->id}}" name="category_id">
                    <div class="form-gorup">
                        <label for="category">Category</label>
                        <input type="text" value="{{$category->name}}" class="@error('categoryName')
                                                    is-invalid
                                                    @enderror form-control rounded-start" name="categoryName">
                        @error('categoryName')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-dark mt-3 rounded-start">Update</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12"></div>



    </div>
</div>

@endsection