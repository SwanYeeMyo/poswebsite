@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row mt-lg-5">
        <div class="col-lg-2 col-sm-12 col-12"></div>
        <div class="col-lg-8 col-sm-12 col-12">
            <div class="card border-0 p-3 mt-5 rounded shadow  ">
                <h5 class="text-center mb-3 text-primary">Please Register Your account </h5>

                <div class="row mt-2">
                    <div class="col-lg-6  col-md-6 col-sm-12 col-12 ">
                        <div class="card text-primary">
                            <img src="{{ asset('Image/pexels-photo-12304527 (1).webp') }}"
                                class="rounded-start card-img-top w-100" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <form action="{{route('register')}}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="@error('name')
                                                     is-invalid  @enderror  form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Username</label>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="@error('email')
                                                                                        is-invalid
                                                                                        @enderror  form-control"
                                    id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="address" class="@error('address')
                                                                                        is-invalid
                                                                                        @enderror  form-control"
                                    id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">address</label>
                                @error('address')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="phone" name="phone" class="@error('phone')
                                                                                        is-invalid
                                                                                        @enderror form-control"
                                    id="floatingPassword" placeholder="phone">
                                <label for="floatingPassword">phone</label>
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="@error('password')
                                                                                        is-invalid
                                                                                        @enderror form-control"
                                    id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input type="password" name="password_confirmation"
                                    class="@error('password_confirmation')
                                                                                                                    is-invalid
                                                                                                                    @enderror form-control"
                                    id="floatingpassword_confirmation" placeholder="password_confirmation">
                                <label for="floatingpassword_confirmation">password_confirmation</label>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mt-lg-5 mt-md-5 mt-3 ">
                                <div class="d-flex justify-content-between">
                                    <a href="{{route('login')}}">
                                        <h6>Already have an account ? </h6>
                                    </a>
                                    <button type="submit" class="btn btn-primary rounded-start">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-12 col-12"></div>
    </div>
</div>
@endsection