@extends('layouts.backend.app')

@section('title', 'Settings')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong><i class="fa fa-cogs"></i>   Settings</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="custom-tab">

                            <nav class="pb-3">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active show" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false">Profile</a>
                                    <a class="nav-item nav-link" id="custom-nav-password-tab" data-toggle="tab" href="#custom-nav-password" role="tab" aria-controls="custom-nav-password" aria-selected="false">Update Password</a>
                                </div>
                            </nav>
                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                                    <form action="#" method="POST" id="updateprofile-form" enctype="multipart/form-data" class="form-horizontal">
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
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="about" class=" form-control-label"><strong>About:</strong></label></div>
                                            <div class="col-12 col-md-9"><textarea name="about" id="about" rows="5" class="form-control">{{ Auth::user()->about }}</textarea></div>
                                        </div>
                            
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="name" class=" form-control-label"><strong>Profile Image:</strong></label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="" name="image" class="form-control-file"></div>
                                        </div>
                                        <div class="form-actions form-group pull-right">
                                            <button type="submit" class="btn btn-primary btn-sm" id="addproject">UPDATE</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-nav-password" role="tabpanel" aria-labelledby="custom-nav-password-tab">
                                    <form action="#" method="POST" id="updatepassword-form" class="form-horizontal">
                                        @csrf
                                        @method('PUT')
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="old_password" class=" form-control-label"><strong>Old Password:</strong></label></div>
                                            <div class="col-12 col-md-9"><input type="password" id="old_password" name="old_password" placeholder="Enter your Old Password" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="password" class=" form-control-label"><strong>New Password:</strong></label></div>
                                            <div class="col-12 col-md-9"><input type="password" id="password" name="password" placeholder="Enter new password" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="password_confirmation" class=" form-control-label"><strong>Confirm Password:</strong></label></div>
                                            <div class="col-12 col-md-9"><input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your new password" class="form-control"></div>
                                        </div>
                                        <div class="form-actions form-group pull-right">
                                            <button type="submit" class="btn btn-primary btn-sm">Update Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    <div class="col-lg-6">
       <div class="card">
        <div class="card-header">
            <i class="fa fa-user"></i><strong class="card-title pl-2">Profile Card</strong>
        </div>
        <div class="card-body">
            <div class="mx-auto d-block pb-3">
                <img class="rounded-circle mx-auto d-block" src="{{ url('storage/profile/'.Auth::user()->image) }}" width="120" height="120" alt="Card image cap">
                <h2 class="text-sm-center mt-2 mb-1 ">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
            </div>
            
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
<script type="text/javascript">
  jQuery(document).ready(function(){
            jQuery('#updateprofile-form').submit(function(e){
              e.preventDefault();
              $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
              jQuery.ajax({
                 url: "{{ route('profile.update') }}", 
                 method: 'post',
                 type: "POST",
                 enctype: 'multipart/form-data',
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
               
                 success: function(result){
                   
                   const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   timerProgressBar: true,
                   onOpen: (toast) => {
                       toast.addEventListener('mouseenter', Swal.stopTimer)
                       toast.addEventListener('mouseleave', Swal.resumeTimer)
                   }
                   })

                   Toast.fire({
                   icon: 'success',
                   title: 'Profile Updated Successfully'
                   });
                   setInterval('location.reload()', 1000);
                 },
                 error: function(request, status, error){
                   //   console.log(result);
                   //   jQuery('.alert').show();
                   //   var r = JSON.parse(result);
                   //   alert(r.message);
                   alert(request.responseText);
                 }
                 });
              });
           });

           $(document).ready(function(){
            $('#updatepassword-form').submit(function(e){
              e.preventDefault();
              $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
              $.ajax({
                 url: "{{ route('password.update') }}", 
                 method: 'post',
                 type: "POST",
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
               
                 success: function(result){
                   
                   const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   timerProgressBar: true,
                   onOpen: (toast) => {
                       toast.addEventListener('mouseenter', Swal.stopTimer)
                       toast.addEventListener('mouseleave', Swal.resumeTimer)
                   }
                   })

                   Toast.fire({
                   icon: 'success',
                   title: 'Password Updated Successfully'
                   });
                   setInterval('location.reload()', 1000);
                 },
                 error: function(request, status, error){
                   //   console.log(result);
                   //   jQuery('.alert').show();
                   //   var r = JSON.parse(result);
                   //   alert(r.message);
                   alert(request.responseText);
                 }
                 });
              });
           });
</script>
@endpush
