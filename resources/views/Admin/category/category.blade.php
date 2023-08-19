@extends('Admin.dashboard')
@section('name','Category')
@section('content')

<div class="container">
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
                <form action="{{route('category#create')}}" method="POST">
                    @csrf
                    <div class="form-gorup">
                        <label for="category">Category</label>
                        <input type="text" class="@error('categoryName')
                                            is-invalid
                                            @enderror form-control rounded-start" name="categoryName">
                        @error('categoryName')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-dark mt-3 rounded-start">Create</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-lg-8  col-md-6 col-12 card shadow p-2 rounded">
            <div class="row">
                <div class="col-lg-4 col-md-6"></div>
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
                <table class="table  table-hover align-middle ">
                    <thead>
                        <tr>
                            <th scope="col">Category_id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($categories))
                        @foreach ($categories as $c )
                        <tr class="">
                            <td scope="row">{{$c->id}}</td>
                            <td>{{$c->name}}</td>
                            <td>{{$c->created_at->format('d/m/y')}}</td>
                            <td>
                                <a href="{{route('category#edit',$c->id)}}">
                                    <button class="my-lg-0 my-1 btn btn-sm btn-primary">Edit</button>
                                </a>

                                <button class="btn btn-sm btn-danger text-light deleteBtn" data-bs-toggle="modal"
                                    data-bs-target="#deleteBtn" title="{{ $c->name }}" value="{{ $c->id }}"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        @if (request('key'))
                        <a href="{{route('category#home')}}" class="my-2 btn btn-primary p-2 ">
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
                <form action="{{ route('category#delete') }}" method="POST">
                    @csrf
                    <div class="modal-dialog ">
                        <div class="modal-content p-lg-4 p-2 shadow rounded">
                            <div class="">
                                <div class="text-center rounded  alert alert-danger alert-dismissible fade show"
                                    role="alert">
                                    <h4><i class="fa-solid border-0 fa-triangle-exclamation fa-beat"></i></h4>
                                    <strong>Careful You won't be abel to see after u delete</strong>

                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="category_id" value="" id="category_id">
                            <h5 class="text-center text-dark">Are you sure do you want to delete <b
                                    class="deleteText"></b> category ?</h5>

                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            {{$categories->links()}}
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
                $('#category_id').val(proudctId);
            });
        });
</script>
@endsection