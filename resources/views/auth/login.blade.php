@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row mt-lg-5 mt-5">
        <div class="col-lg-3  col-12"></div>
        <div class="col-lg-6  col-12">
            <div class="card shadow p-3 mt-5 rounded">

                <div class="d-flex justify-content-center">
                    <div class="mt-3">
                        <h5 class="text-center text-primary">
                            Welcome Back !
                        </h5>
                        <p class="text-secondary text-center">
                            Hope you have a wonderful day .
                        </p>
                    </div>
                </div>
                <form action="{{route('login.github')}}" method="get" class="text-center">
                    @csrf
                    <button class="btn btn-primary">
                        <i class="fa-brands fa-github"></i>
                    </button>
                </form>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab" tabindex="0">
                        <div class="card border-0 p-3">
                            <form action="{{route('login')}}" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="@error('email')
                                    is-invalid
                                    @enderror rounded-start form-control" id="floatingInput"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Email address</label>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="@error('password')
                                    is-invalid
                                    @enderror rounded-start form-control" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="{{route('register')}}">
                                            <h6>
                                                Don't have an account ?
                                            </h6>
                                        </a>

                                      <div>
                                        <button type="submit" class="btn btn-primary rounded-start">
                                            login
                                        </button>

                                      </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-3  col-12"></div>
</div>
</div>
@endsection
