@extends('layouts.backend.app')

@section('title', 'Settings')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-home"></i>  Update Profile</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="first_name" class=" form-control-label"><strong>First Name:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="text" id="first_name" name="first_name" placeholder="Enter your First Name" class="form-control" value="{{ Auth::user()->first_name }}"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="last_name" class=" form-control-label"><strong>Last Name:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="text" id="last_name" name="last_name" placeholder="Enter your Last Name" class="form-control" value="{{ Auth::user()->last_name }}"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="phone_no" class=" form-control-label"><strong>Phone Number:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="text" id="phone_no" name="phone_no" placeholder="Enter your Phone Number" class="form-control" value="{{ Auth::user()->phone_no }}"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="id_number" class=" form-control-label"><strong>ID Number / Passport No:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="text" id="id_number" name="id_number" placeholder="Enter your ID / Passport No" class="form-control" value="{{ Auth::user()->id_number }}"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="email" class=" form-control-label"><strong>Email Address:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="email" id="email" name="email" placeholder="Enter your Email Address" class="form-control" value="{{ Auth::user()->email }}"></div>
                    </div>
                    {{-- <div class="row form-group">
                        <div class="col col-md-3"><label for="old password" class=" form-control-label"><strong>Old Password:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="password" id="password" name="password" placeholder="Enter your old password" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="password" class=" form-control-label"><strong>Password:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="password" id="password-input" name="password" placeholder="Enter new password" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="password" class=" form-control-label"><strong>Confirm Password:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="password" id="password" name="password" placeholder="Confirm new password" class="form-control"></div>
                    </div> --}}
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="about" class=" form-control-label"><strong>About:</strong></label></div>
                        <div class="col-12 col-md-9"><textarea name="about" id="about" rows="5" class="form-control">{{ Auth::user()->about }}</textarea></div>
                    </div>
        
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="name" class=" form-control-label"><strong>Profile Image:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="file" id="" name="image" class="form-control-file"></div>
                    </div>
                    <div class="form-actions form-group pull-right">
                        {{-- <button type="cancel" class="btn btn-secondary btn-sm">Cancel</button> --}}
                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
       {{-- <div class="card">
           <div class="card-header text-center">
             <strong><i class="fa fa-user"></i>  Profile</strong>
           </div>
           <div class="card-body card-block">
            <div class="card-body">
                <!-- Credit Card -->
                <div id="pay-invoice">
                    <div class="card-body">
                        <div class="card-image">
                           <img class="user-avatar rounded-circle" src="{{ url('storage/profile/'.Auth::user()->image) }}" width="120" height="120" alt="User Image">
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="text-center">
                                Name: <strong> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong>
                              </div>
                              <div class="text-center">
                                  Phone No: <strong> {{ Auth::user()->phone_no }}</strong>
                              </div>
                              <div class="text-center">
                                  ID Number: <strong> {{ Auth::user()->id_number }}</strong>
                              </div>
                              <div class="text-center">
                                  Email: <strong> {{ Auth::user()->email }}</strong>
                              </div>
                              <div class="text-center">
                                 About: <strong> {{ Auth::user()->about }}</strong>
                              </div>
                        </div>
                    </div>
                </div>

            </div>
            </div>
       </div> --}}
       <div class="card">
        <div class="card-header">
            <i class="fa fa-user"></i><strong class="card-title pl-2">Profile Card</strong>
        </div>
        <div class="card-body">
            <div class="mx-auto d-block">
                <img class="rounded-circle mx-auto d-block" src="{{ url('storage/profile/'.Auth::user()->image) }}" width="120" height="120" alt="Card image cap">
                <h2 class="text-sm-center mt-2 mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
            </div>
            <hr>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <span class="badge badge-primary"><i class="fa  fa-envelope"></i> </span><span class="pull-right">{{ Auth::user()->email }}</span>
                </li>
                <li class="list-group-item">
                    <span class="badge badge-success"><i class="fa fa-phone"></i></span> <span class="pull-right">{{ Auth::user()->phone_no }}</span></a>
                </li>
                <li class="list-group-item">
                    <span class="badge badge-dark"><i class="fa fa-id-card"></i></span> <span class="pull-right">{{ Auth::user()->id_number }}</span></a>
                </li>
                <li class="list-group-item">
                    <span class="badge badge-warning"><i class="fa fa-comment"></i></span> <span class="pull-right">{{ Auth::user()->about }}</span></a>
                </li>
            </ul>
        </div>
    </div>
    </div>
</div>
@endsection

@push('js')

@endpush
