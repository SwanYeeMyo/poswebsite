@extends('Admin.dashboard')
@section('name','Admin Profile')
@section('content')
<div class="container">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-12">
            <div class="white-box shadow">
                <form action="{{route('admin#update')}}" enctype="multipart/form-data"
                    class="form-horizontal form-material" method="POST">
                    @csrf
                    <input type="hidden" value="{{Auth::user()->id}}" name="id">
                    @if (Auth::user()->image)
                    <div class="user-bg rounded"> <img width="100%" alt="user"
                            src="{{ asset('storage/' . Auth::user()->image ) }}">
                        @else
                        <div class="user-bg"> <img width="100%" alt="user" src="{{ asset('Image/default.webp') }}">
                            @endif
                            <div class="overlay-box">
                                <div class="user-content">
                                    <h4 class="text-white mt-2">{{Auth::user()->name}}</h4>
                                    <h5 class="text-white mt-2">{{Auth::user()->email}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <input type="file" name="adminImage" class="@error('adminImage')
                            is-invaild
                        @enderror  form-control">
                        @error('adminImage')
                        <div class="invald-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Full Name</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" name="adminName" value="{{Auth::user()->name}}" class="@error('adminName')
                                is-invalid
                                    @enderror   form-control p-0 border-0">
                                @error('adminName')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="example-email" class="col-md-12 p-0">Email</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="email" value="{{Auth::user()->email}}" name="adminEmail" class="@error('adminEmail')
                                is-invalid
                                    @enderror  form-control p-0 border-0" name="example-email" id="example-email">
                                @error('adminEmail')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Phone No</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" value="{{Auth::user()->phone}}" name="adminPhone" class="@error('adminPhone')
                                     is-invalid
                                    @enderror   form-control p-0 border-0">
                                @error('adminPhone')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Address</label>
                            <div class="col-md-12 border-bottom p-0">
                                <textarea rows="5" name="adminAddress" class="@error('adminAddress')
                                is-invalid
                                @enderror   form-control p-0 border-0">
                                    {{Auth::user()->address}}
                                </textarea>
                                @error('adminAddress')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Role</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" " disabled value=" {{Auth::user()->role}}" class=")
                                form-control p-0 border-0">



                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-primary text-light">Update Profile</button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
    @endsection