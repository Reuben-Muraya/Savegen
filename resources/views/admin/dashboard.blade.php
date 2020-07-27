@extends('layouts.backend.app')

@section('title', 'Dashboard')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
       <div class="card text-white bg-flat-color-3">
           <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="count">{{ $users->count() }}</span>
                    </h3>
                    <p class="text-light mt-1 m-0">Total Users</p>
                </div><!-- /.card-left -->
                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg pe-7s-users"></i>
                </div><!-- /.card-right -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush