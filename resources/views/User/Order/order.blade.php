@extends('layouts.user.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 mt-5">
            <div class="table-responsive">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>

                            <th>Name</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Location</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $o )
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">{{Auth::user()->name}}</p>
                                        <p class="text-muted mb-0">{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <p class="text-muted mb-0">{{$o->total_price}}</p>
                            </td>
                            <td>
                                @if ($o->status == 0)
                                <span class="badge badge-warning rounded-pill d-inline">
                                    pending
                                </span>
                                @elseif ($o->status == 1)
                                <span class="badge badge-success rounded-pill d-inline">
                                    success
                                </span>
                                @elseif ($o->status == 2)
                                <span class="badge badge-danger rounded-pill d-inline">
                                    denied
                                </span>
                                @endif

                            </td>
                            <td>
                                <span>{{Auth::user()->address}}</span>
                            </td>
                            <td>
                                <span>{{$o->created_at->format('d/m/y')}}</span>
                            </td>
                            @endforeach


                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
@endsection
