@extends('Admin.dashboard')
@section('name','Admin Edit Page')
@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-4">
            <form action="{{route('admin#listUpdate')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" value="{{$admin->id}}" name="id">
                <div class="card p-3">
                    @if ($admin->image)
                    <img src="{{ asset('storage/' . $admin->image ) }}" class="rounded" alt="">
                    @else
                    <img src="{{ asset('Image/default.webp') }}" class="rounded" alt="">
                    @endif
                    <div class="form-group my-3">
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
        </div>
        <div class="col-lg-8 ">
            <div class="card p-3 ">
                <div class="form-group mb-3">
                    <label for="">User name</label>
                    <input type="text" name="name" value="{{old('name',$admin->name)}}" class=" @error('name') is-invalid @enderror
                        form-control">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" name="email" value="{{old('email',$admin->email)}}" class=" @error('email') is-invalid @enderror
                                        form-control">
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Address</label>
                    <input type="text" name="address" value="{{old('address',$admin->address)}}" class=" @error('address') is-invalid @enderror
                                        form-control">
                    @error('address')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Phone</label>
                    <input type="text" name="phone" value="{{old('phone',$admin->phone)}}" class=" @error('phone') is-invalid @enderror
                                        form-control">
                    @error('phone')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Role</label>
                    <select name="role" class="@error('role') is-invalid @enderror  form-select form-select-sm"
                        aria-label=".form-select-sm example">
                        @if ($admin->role == 'user')
                        <option selected value="user">user</option>
                        <option value="admin">admin</option>
                        @else
                        <option value="user">user</option>
                        <option selected value="admin">admin</option>
                        @endif
                        @error('role')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </select>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-dark">
                        Update
                    </button>
                </div>
            </div>

        </div>

        </form>
    </div>
</div>
@endsection