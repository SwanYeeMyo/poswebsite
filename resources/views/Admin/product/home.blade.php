@extends('Admin.dashboard')
@section('name','Product')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            @if (session('success'))
            <div class="alert rounded-pill bg-success text-light alert-dismissible fade show" role="alert">
                <i class="mx-2 fa-regular fa-circle-check fa-bounce"></i> {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow rounded p-3">
                <form action="{{route('admin#ProductCreate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="productName" value="{{old('productName')}}" class="@error('productName')
                                is-invalid
                                @enderror form-control">
                        @error('productName')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <select name="category_id" value="{{old('category_id')}}" class="@error('category_id')
                        @enderror  form-select form-select" aria-label=".form-select-sm example">
                            @foreach ($categories as $c )
                            <option value="{{$c->id}}">{{$c->name}}</option>
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
                        @enderror form-control" id="" cols="30" rows="10">{{old('description')}}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Price</label>
                        <input type="number" name="price" value="{{old('price')}}" class="@error('price')
                                                                        is-invalid
                                                                        @enderror form-control">
                        @error('price')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="@error('image')
                                                                        is-invalid
                                                                        @enderror form-control">
                        @error('image')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>

                        @enderror
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        <button class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <div class="col-lg-8  col-md-6 col-12 card shadow p-2 rounded">
            <div class="row">
                <div class="col-lg-4 col-md-6">


                </div>
                <div class="col-lg-4 col-md-6"></div>
                <div class="col-lg-4 col-md-6">
                    <form action="" method="GET">
                        @csrf
                        <div class="d-flex ">
                            <input type="text" value="{{request('key')}}" name="key" class="form-control rounded-pill">
                            <button class="mx-2 p-2 rounded-pill  btn btn-primary btn-sm">
                                <i class="fa-solid fa-magnifying-glass fa-fade"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive ">
                <table class="table mt-3  table-hover align-middle ">
                    <thead>
                        <tr>
                            <th>Product_Id</th>
                            <th>Name</th>
                            <th>Categories</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>view_count</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products))
                        @foreach ($products as $p )

                        <tr class="">
                            <td class="fw-bold">{{$p->id}}</td>
                            <td>
                                {{$p->name}}</td>
                            <td>{{$p->category_name}}</td>
                            <td>{{$p->price}} Kyats</td>
                            <td>
                                <a href="{{url('storage/'.$p->image)}}">
                                    <img src="{{ asset('storage/' . $p->image) }}" style="width:80px" alt="">
                                </a>
                            </td>
                            <td>0</td>
                            <td>{{$p->created_at->format('d/m/y')}}</td>
                            <td>

                                <a href="{{route('admin#ProductEdit',$p->id)}}">
                                    <button class="my-lg-0 my-1 btn btn-sm btn-primary">Edit</button>
                                </a>

                                <button class="btn btn-sm btn-danger text-light deleteBtn" data-bs-toggle="modal"
                                    data-bs-target="#deleteBtn" title="{{ $p->name }}" value="{{ $p->id }}"><i
                                        class="fa-solid fa-trash-can"></i></button>

                                <a href="{{route('admin#productView', $p->id)}}" class=" my-1 btn btn-sm btn-primary">

                                    <i class="fa-solid fa-eye"></i>

                                </a>
                            </td>
                        </tr>

                        @endforeach
                        @endif
                        @if (request('key'))
                        <a href="{{route('admin#product')}}" class="my-2 btn btn-primary p-2 ">
                            <i class="fa-solid fa-backward fa-beat"></i>
                        </a>
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- modal confirmation --}}
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="deleteBtn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <form action="{{ route('admin#ProductDelete') }}" method="POST">
                    @csrf
                    <div class="modal-dialog ">
                        <div class="modal-content p-lg-4 p-2 shadow rounded">
                            <input type="hidden" class="form-control" name="product_id" value="" id="product">
                            <h5 class="text-center text-dark">Are you sure do you want to delete <strong
                                    class="deleteText"></strong> ?</h5>

                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            {{$products->links()}}
        </div>


    </div>
</div>
<script>
    $(document).ready(function() {
            $('.deleteBtn').click(function() {
                var proudctId = $(this).val();
                console.log(proudctId);
                var title = $(this).attr('title');
                $('.deleteText').text(title);
                $('#product').val(proudctId);
            });
        });
</script>
@endsection
