@extends('layouts.backend.app')

@section('title', 'Users')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<div class="card">
    <div class="card-header"><strong>User Details</div>
    <form action="{{ route('users.update',$users->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body card-block">
            <div class="form-group"><label for="username" class=" form-control-label">Username</label><input type="text" name="username" id="username" class="form-control" value="{{ $users->username }}"></div>
            <div class="form-group"><label for="email" class=" form-control-label">Email</label><input type="email" id="email" class="form-control" value="{{ $users->email }}"></div>
            <div class="form-group"><label for="password" class=" form-control-label">Password</label><input type="password" id="password" class="form-control"></div>
            <div class="form-group"><label for="confirm_password" class=" form-control-label">Confirm Password</label><input type="password" id="confirm_password" class="form-control"></div>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">BACK</a>
        <button type="submit" class="btn btn-primary">UPDATE</button>
    </form>
</div>
@endsection

@push('js')
   <!-- Scripts -->
   <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>



   <script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
   <script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
   <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
   <script src="{{ asset('assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
   <script src="{{ asset('assets/js/lib/data-table/jszip.min.js') }}"></script>
   <script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js') }}"></script>
   <script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
   <script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js') }}"></script>
   <script src="{{ asset('assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
   <script src="{{ asset('assets/js/init/datatables-init.js') }}"></script>


   <script type="text/javascript">
       $(document).ready(function() {
         $('#bootstrap-data-table-export').DataTable();
     } );
 </script>
@endpush