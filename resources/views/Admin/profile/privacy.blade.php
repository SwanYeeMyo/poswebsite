@extends('Admin.dashboard')
@section('name','Change Password')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            @if (session('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card rounded shadow p-3">

                <form action="{{route('admin#changePassword')}}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Old Password</label>
                        <input type="password" id="oldPassword" name="oldPassword" class="@error('oldPassword')
                                            is-invalid
                                            @enderror form-control ">
                        @error('oldPassword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" class="@error('newPassword')
                        is-invalid
                        @enderror form-control">
                        @error('newPassword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Confirmation Password</label>
                        <input type="password" id="confirmPassword" name="confirmationPassword" class="@error('confirmationPassword')
                        is-invalid
                        @enderror form-control">
                        @error('confirmationPassword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="showPassword">
                            <label class="form-check-label" for="flexCheckChecked">
                                showpassword
                            </label>
                        </div>
                        <div class="">
                            <button class="btn btn-primary rounded ">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
<script>
    var oldPassword = document.getElementById('oldPassword');
    var newPassword = document.getElementById('newPassword');
    var confirmPassword = document.getElementById('confirmPassword')
    var showPassword = document.getElementById('showPassword');
    showPassword.addEventListener('change',function(){
        getData();
    });
    function getData(){
        if(oldPassword.type == 'password' && newPassword.type && confirmPassword.type){
        oldPassword.type = 'text'
        newPassword.type = 'text'
        confirmPassword.type = 'text'
        }else{
        oldPassword.type = 'password'
        newPassword.type = 'password'
        confirmPassword.type = 'password'
        }
    }
</script>
@endsection