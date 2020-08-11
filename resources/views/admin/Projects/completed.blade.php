@extends('layouts.backend.app')

@section('title', 'Completed Projects')

@push('css')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid row">
        <div class="block-header">
            <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm" type="submit">
                <span><i class="fa fa-backward">  Back</i></span>   
            </a>
        </div> 
        <div class="block-header">
            <a href="{{ route('projects.failed') }}" class="btn btn-danger btn-sm" type="submit">
                <span><i class="fa  fa-exclamation-triangle"></i> Failed Projects</span>
            </a>
        </div> 
    </div>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Completed Project List <span class="badge badge-primary">{{$projects->count() }}</span></strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Deal Value</th>
                                    {{-- <th>Deal Expense</th>
                                    <th>Deal Profit</th> --}}
                                    <th>Start Date</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $key=>$project)
                                <tr>
                                   <td>{{ $key + 1 }}</td>
                                   <td>{{ $project->description }}</td>
                                   <td>Ksh {{ $project->deal_value }}</td>
                                   <td>{{ $project->start_date }}</td>
                                   {{-- <td></td>
                                   <td></td>
                                   <td></td>
                                   <td></td> --}}
                                   <td><img class="user-avatar rounded-circle" src="{{ url('storage/project/'.$project->image) }}" width="50" height="50" alt="Project Image"></td>
                                   <td class="text-center">
                                    <a href="{{ route('projects.show',$project->id) }}"><i class="fa fa-eye" style="color: navy"></i></a> |
                                    <a href="#" data-toggle="modal" data-target="#edit-loan"><i class="fa fa-pencil" style="color: aqua"></i></a> |
                                    <p-button class="btn btn-danger" type="submit" style='background-color: transparent; border: none' onclick="deleteProject({{ $project->id }})">
                                      <i style='color:red' class="fa fa-trash-o" [ngClass]="{'active': pinned}"></i>
                                    </p-button>
                                    <form id="delete-form-{{ $project->id }}" action="{{ route('projects.destroy',$project->id) }}" method="POST" style="display: none;">
                                      @csrf
                                      @method('DELETE')
                                    </form>
                                  </td>
                                 </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection

@push('js')
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
   {{-- <script type="text/javascript">
       $(document).ready(function() {
         $('#bootstrap-data-table-export').DataTable();
     } );
 </script> --}}
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

   <script type="text/javascript">
    function deleteProject(id) {
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.value) {
        event.preventDefault();
        document.getElementById('delete-form-'+id).submit();
        Swal.fire(
           'Deleted!',
           'Your file has been deleted.',
           'success'
         )
         setInterval('location.reload()', 1000);
    }
    });
 }

jQuery(document).ready(function(){
            jQuery('#addproject-form').submit(function(e){
              e.preventDefault();
              $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
              jQuery.ajax({
                 url: "{{ route('projects.store') }}",
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
                   title: 'Project Submitted successfully'
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