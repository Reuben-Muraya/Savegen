@extends('layouts.backend.app')

@section('title', 'Expenses')

@push('css')

@endpush

@section('content')

{{-- Start Add Modal --}}
  
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel"><strong>Add Expense</strong></h5>
        </div>
        <form action="#" method="POST" id="addexpense-form" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                  <label for="description"><strong>Description: <span style="color: red">*</span></strong></label>
                  <input type="text" name="description" class="form-control" placeholder="Enter the description" required>
              </div>
              <div class="form-group">
                  <label for="amount"><strong>Amount: <span style="color: red">*</span></strong></label>
                  <input type="text" name="amount" class="form-control" placeholder="Enter the Amount" required>
              </div>
              <div class="form-group">
                  <label for="image"><strong>ID / Passport Image:</strong></label>
                  <input type="file" name="image"> 
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="addexpense">Submit Expense</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  
{{-- End Add Modal --}}

<div class="content">
    <div class="block-header">
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
            <span><i class="fa fa-plus"></i> Add Expense</span>
        </button>
    </div>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Expenses List <span class="badge badge-primary">{{$expenses->count() }}</span></strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $key=>$expense)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $expense->description }}</td>
                                    <td>Ksh {{ $expense->amount }}</td>
                                    <td><img class="user-avatar rounded-circle" src="{{ url('storage/expense/'.$expense->image) }}" width="50" height="50" alt="Expense Image"></td>
                                    <td>{{ $expense->created_at }}</td>
                                    <td class="text-center">
                                        <p-button class="btn btn-info" type="submit" data-toggle="modal" data-target="#updatecontribution" style='background-color: transparent; border: none'>
                                          <i style='color:aqua' class="fa fa-pencil" [ngClass]="{'active': pinned}"></i>
                                        </p-button> |
                                        <p-button class="btn btn-danger" type="submit" style='background-color: transparent; border: none' onclick="deleteExpense({{ $expense->id }})">
                                          <i style='color:red' class="fa fa-trash-o" [ngClass]="{'active': pinned}"></i>
                                        </p-button>
                                        <form id="delete-form-{{ $expense->id }}" action="{{ route('expenses.destroy',$expense->id) }}" method="POST" style="display: none;">
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
    function deleteExpense(id) {
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
            jQuery('#addexpense-form').submit(function(e){
              e.preventDefault();
              $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
              jQuery.ajax({
                 url: "{{ route('expenses.store') }}",
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
                   title: 'Expense Submitted successfully'
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