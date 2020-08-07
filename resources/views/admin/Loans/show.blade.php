@extends('layouts.backend.app')

@section('title', 'Loans')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="block-header">
            <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm" type="submit">
                <span><i class="fa fa-backward">  Back</i></span>   
            </a>
        </div> 
        <div class="card">
        <div class="card-header">
            <i class="fa fa-money"></i><strong class="card-title pl-2">Loan Details</strong>
        </div>
        <div class="card-body">
            <div class="mx-auto d-block">
                <img class="rounded mx-auto d-block" src="{{ url('storage/loan/'.$loan->image) }}" width="220" height="180" alt="Card image cap">
            </div>
            <hr>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <span class="badge badge-primary"><i class="fa  fa-user"></i> </span> <span class="pull-right">{{ $loan->first_name }} {{ $loan->last_name }}</span>
                </li>
                <li class="list-group-item">
                    <span class="badge badge-success"><i class="fa fa-phone"></i></span> <span class="pull-right">{{ $loan->phone_no }}</span></a>
                </li>
                <li class="list-group-item">
                    <span class="badge badge-dark"><i class="fa fa-id-card"></i></span> <span class="pull-right">{{ $loan->id_number }}</span></a>
                </li>
                <li class="list-group-item">
                    <span class="badge badge-warning"><i class="fa fa-envelope"></i></span> <span class="pull-right">{{ $loan->email }}</span></a>
                </li>
                <li class="list-group-item">
                    <span class="badge badge-info"><i class="fa fa-money"></i></span> <span class="pull-right">ksh {{ $loan->amount }}</span></a>
                </li>
                <li class="list-group-item">
                    <span class="badge badge-danger"><i class="fa fa-calendar"></i></span> <span class="pull-right">{{ $loan->created_at }}</span></a>
                </li>
            </ul>
        </div>
       </div>
    </div>
    <div class="col-lg-8">
        {{-- <div class="card">
            <div class="card-header">
                <strong class="card-title">Loans List <span class="badge badge-primary"></span></strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Reuben</td>
                            <td>dgdjkjk</td>
                            <td>dgdjkjk</td>
                            <td>dgdjkjk</td>
                            <td>dgdjkjk</td>
                            <td>dgdjkjk</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}
        {{-- <div class="card">
            <div class="card-header">
                <strong class="card-title">Table Dark</strong>
            </div>
            <div class="card-body">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
</div>

@endsection

@push('js')

@endpush