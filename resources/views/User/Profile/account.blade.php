@extends('layouts.user.master')
@section('content')
<div class="container mt-5">
    <div class="row w-100">
        <div class="col-3">
            <!-- Tab navs -->
            <div class="nav flex-column nav-pills text-center" id="v-tabs-tab" role="tablist"
                aria-orientation="vertical">
                <a class="nav-link active" id="v-tabs-home-tab" data-mdb-toggle="tab" href="#v-tabs-home" role="tab"
                    aria-controls="v-tabs-home" aria-selected="true">Profile Content</a>

                <a class="nav-link" id="v-tabs-messages-tab" data-mdb-toggle="tab" href="#v-tabs-messages" role="tab"
                    aria-controls="v-tabs-messages" aria-selected="false">Security</a>

                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="btn btn-danger">Logout</button>
                </form>
            </div>
            <!-- Tab navs -->
        </div>

        <div class="col-9  p-2">
            <!-- Tab content -->
            <div class="tab-content  p-2" id="v-tabs-tabContent">
                <div class="tab-pane fade show active" id="v-tabs-home" role="tabpanel"
                    aria-labelledby="v-tabs-home-tab">
                    <h6 class="text-dark mx-3 my-2">My Profile</h6>
                    <a href="{{route('user#home')}}">
                        <button class="btn btn-dark my-2">
                            Back
                        </button>
                    </a>
                    <div class="mt-1">
                        <div class="row p-2">
                            <div class="col-lg-4 col-md-6">
                                <div class="p-2 ">
                                    <form action="{{route('user#update')}}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @if (Auth::user()->image)
                                        <img src="{{ asset('storage/'. Auth::user()->image) }}"
                                            class="rounded-7 card-img-top" alt="">
                                        @else
                                        <img src="{{ asset('Image/default.webp') }}" class="card-img-top" alt="">
                                        @endif
                                        <div class="from-group my-3">
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                </div>
                            </div>

                            <div class="col-lg-8 col-md-6">
                                <div class="card p-3">
                                    <div class="from-group mb-3">
                                        <label for="">Name</label>
                                        <input type="text" placeholder="name" value="{{ Auth::user()->name}}"
                                            name="name" class="@error('name')
                                        is-invalid
                                        @enderror form-control">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="from-group mb-3">
                                        <label for="">Email</label>
                                        <input type="email" placeholder="Email" value="{{Auth::user()->email}}"
                                            name="email" class="@error('email')
                                        is-invalid
                                        @enderror form-control">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="from-group mb-3">
                                        <label for="">address</label>
                                        <input type="text" placeholder="Address" value="{{ Auth::user()->address}}"
                                            name="address" class="@error('address')
                                                                            is-invalid
                                                                            @enderror form-control">
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="from-group mb-3">
                                        <label for="">Phone</label>
                                        <input type="text" placeholder="Phone" value="{{ Auth::user()->phone}}"
                                            name="phone" class="@error('phone')
                                                                            is-invalid
                                                                            @enderror form-control">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="from-group mb-3">
                                        <label for="">Role</label>
                                        <input type="text" disabled placeholder="role" value="{{ Auth::user()->role}}"
                                            name="role" class="@error('role')
                                                                            is-invalid
                                                                            @enderror form-control">
                                        @error('role')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-dark">
                                        Updtae
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-tabs-messages" role="tabpanel" aria-labelledby="v-tabs-messages-tab">
                    Password
                </div>
            </div>
            <!-- Tab content -->
        </div>
    </div>
</div>
@endsection