@extends('Admin.dashboard')
@section('name','Admin List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-sm-3">

            @if (session('success'))
            <div class="alert rounded-pill bg-success text-light alert-dismissible fade show" role="alert">
                <i class="mx-2 fa-regular fa-circle-check fa-bounce"></i> {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

        </div>
        <div class="col-lg-4 col-sm-3"></div>
        <div class="col-lg-4 col-sm-6">
            <form action="">
                <div class="d-flex">
                    <input type="text" value="{{request('key')}}" name="key" class="form-control rounded-pill">
                    <button class="mx-2 p-2 rounded-pill  btn btn-primary btn-sm">
                        <i class="fa-solid fa-magnifying-glass fa-fade"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="mt-3 ">
            <div class="card rounded p-3">
                @if (count($admins))
                <div class="table-responsive">
                    <table class=" table mt-3 text-nowrap table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (request('key'))
                            <div>
                                <a href="{{route('admin#list')}}" class="btn btn-primary">
                                    Back</a>
                            </div>
                            @endif
                            @foreach ($admins as $a)


                            <tr class="">
                                <td scope="row">{{$a->id}}</td>
                                <td scope="row">
                                    @if ($a->image)
                                    <img src="{{ asset('storage/'. $a->image) }}" class="rounded-pill"
                                        style="width:50px" alt="">
                                    @else
                                    <img src="{{ asset('Image/default.webp') }}" class="rounded-pill" style="width:50px"
                                        alt="">
                                    @endif
                                </td>
                                <td scope="row">{{$a->name}}</td>
                                <td scope="row">{{$a->email}}</td>
                                <td scope="row">{{$a->address}}</td>
                                <td scope="row">{{$a->phone}}</td>
                                <td scope="row">
                                    @if ($a->role == 'user')
                                    <span class="badge bg-warning rounded-pill">{{$a->role}}</span>
                                    @else
                                    <span class="badge bg-primary rounded-pill">{{$a->role}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($a->id != Auth::user()->id)
                                    <button class="btn btn-sm btn-danger text-light deleteBtn" data-bs-toggle="modal"
                                        data-bs-target="#deleteBtn" title="{{ $a->name }}" value="{{ $a->id }}"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                    @endif
                                    <a href="{{route('admin#listEdit',$a->id)}}" class="button btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="d-flex justify-content-center p-3 flex-column ">

                    <h3 class="text-uppercase text-danger text-center">
                        {{request('key')}}
                    </h3>
                    <h5 class="text-center">Not found what you are looking for </h5>
                    <div>
                        <a href="{{route('admin#list')}}" class="btn btn-primary">
                            Back</a>
                    </div>
                </div>
                @endif
                <div class="mt-3">
                    {{$admins->links()}}
                </div>
            </div>

        </div>
    </div>


</div>
<!-- Modal -->
<div class="modal fade" id="deleteBtn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{ route('admin#listDelete' ) }}" method="POST">
        @csrf
        <div class="modal-dialog ">
            <div class="modal-content p-lg-4 p-2 shadow rounded">
                <input type="hidden" class="form-control" name="admin_id" value="" id="product">
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