@extends('layouts.backend.app')

@section('title', 'Users')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
{{-- <div class="card">
    <div class="card-header">
        <strong class="card-title">Users List <span class="badge badge-primary">{{$users->count() }}</span></strong>
    </div>
    <div class="table-stats order-table ov-h">
        <table class="table ">
            <thead class="thead-dark">
                <tr>
                    <th class="serial">#</th>
                    <th class="avatar">Avatar</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Date Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key=>$user)
                  <tr>
                    <td class="serial">{{ $key + 1 }}</td>
                    <td class="avatar">
                        <div class="round-img">
                            <a href="#"><img class="rounded-circle" src="{{ asset('assets/img/avatar/1.jpg') }}" alt=""></a>
                        </div>
                    </td>
                    <td><span class="name">{{ $user->username }}</span> </td>
                    <td>{{ $user->email }}</td>
                    <td>Admin</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('users.edit',$user->id) }}" style="color: cyan">
                            <i class="fa fa-pencil"></i>
                        </a> | 
                        <a href="#" style="color: red">
                            <i class="fa fa-trash-o"></i>
                         </a>
                    </td>
                  </tr> 
                @endforeach
                    
            </tbody>
        </table>
    </div> <!-- /.table-stats -->
</div> --}}
<div class="card">
    <div class="card-header">
        <strong class="card-title">Users List <span class="badge badge-primary">{{$users->count() }}</strong>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Avatar</th>
                  <th scope="col">User Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
                  <th scope="col">Date Joined</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($users as $key=>$user)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td class="avatar">
                    <div class="round-img">
                        <a href="#"><img class="rounded-circle" src="{{ asset('assets/img/avatar/1.jpg') }}" alt=""></a>
                    </div>
                </td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>Admin</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('users.edit',$user->id) }}" style="color: cyan">
                            <i class="fa fa-pencil"></i>
                        </a> | 
                        <a href="#" style="color: red">
                            <i class="fa fa-trash-o"></i>
                         </a>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
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