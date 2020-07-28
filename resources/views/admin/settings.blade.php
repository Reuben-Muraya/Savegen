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
                        <div class="col col-md-3"><label for="name" class=" form-control-label"><strong>Username:</strong></label></div>
                        <div class="col-12 col-md-9"><input type="text" id="username" name="username" placeholder="Enter your username" class="form-control" value="{{ Auth::user()->username }}"></div>
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
       <div class="card">
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
                                Username: <strong> {{ Auth::user()->username }}</strong>
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
       </div>
    </div>
</div>
@endsection

@push('js')

@endpush
