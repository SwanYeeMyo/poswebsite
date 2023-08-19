@extends('Admin.dashboard')
@section('content')
<form action="{{route('logout')}}" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>
@endsection