@extends('layouts.backend.app')

@section('title', 'Dashboard')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="currency float-left mr-1">Ksh</span>
                        <span class="count">335697</span>
                    </h3>
                    <p class="text-light mt-1 m-0">Revenue To Date</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg pe-7s-cash"></i>
                </div><!-- /.card-right -->
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="currency float-left mr-1">Ksh</span>
                        <span class="count">{{ $all_contributions }}</span>
                    </h3>
                    <p class="text-light mt-1 m-0">Total Contributions</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg pe-7s-cash"></i>
                </div><!-- /.card-right -->
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-5">
            <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="currency float-left mr-1">Ksh</span>
                        <span class="count">20000</span>
                    </h3>
                    <p class="text-light mt-1 m-0">Profit Made</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg pe-7s-cash"></i>
                </div><!-- /.card-right -->
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-6">
            <div class="card-body">
                 <div class="card-left pt-1 float-left">
                     <h3 class="mb-0 fw-r">
                        <span class="currency float-left mr-1">Ksh</span>
                         <span class="count">{{ $all_loans }}</span>
                     </h3>
                     <p class="text-light mt-1 m-0">Loans Given Amount</p>
                 </div><!-- /.card-left -->
                 <div class="card-right float-right text-right">
                     <i class="icon fade-5 icon-lg pe-7s-cash"></i>
                 </div><!-- /.card-right -->
             </div>
         </div>
     </div>
    
</div>
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
     <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="currency float-left mr-1">Ksh</span>
                        <span class="count">{{ $all_expenses }}</span>
                    </h3>
                    <p class="text-light mt-1 m-0">Total Expenses</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg pe-7s-cash"></i>
                </div><!-- /.card-right -->
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="currency float-left mr-1">Ksh</span>
                        <span class="count">{{ $all_projects }}</span>
                    </h3>
                    <p class="text-light mt-1 m-0">Total Projects Amount</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg pe-7s-cash"></i>
                </div><!-- /.card-right -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush