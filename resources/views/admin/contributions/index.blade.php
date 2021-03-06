@extends('layouts.backend.app')

@section('title', 'Contributions')

@push('css')

@endpush

@section('content')

{{-- Start Add Modal --}}
  
<div class="modal fade" id="addcontribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Add Contribution</strong></h5>
        </div>
        <form action="#" id="addcontribution-form"  method="POST">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                  <label for="users">Select a member <span style="color: red">*</span></label>
                  <select name="users[]" id="user" class="form-control" required>
                    {{-- <option value="">Select member</option> --}}
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label for="amount"><strong>Amount: <span style="color: red">*</span></strong></label>
                  <input type="text" name="amount" class="form-control" placeholder="Enter the amount" required>
              </div>
              <div class="form-group">
                  <label for="date"><strong>Date: <span style="color: red">*</span></strong></label>
                  <input type="date" class="form-control" name="date" placeholder="Select the date" required>
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Contribution</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  
{{-- End Add Modal --}}

  {{-- Start Edit Modal1 --}}
  {{-- <div class="modal fade" id="updatecontribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Contribution</h5>
        </div>
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                  <label for="users"><strong>Member:</strong></label>
                  <input type="text" id="name" name="name" class="form-control" value="">
              </div>
              <div class="form-group">
                  <label for="amount"><strong>Amount:</strong></label>
                  <input type="text" name="amount" class="form-control" placeholder="Enter the amount" required value="">
              </div>
              <div class="form-group">
                  <label for="date"><strong>Date:</strong></label>
                  <input type="date" class="form-control" name="date" placeholder="Select the date" required value="">
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Contribution</button>
            </div>
        </form>
      </div>
    </div>
  </div> --}}
  {{-- End Edit Modal --}}

<div class="content">
    <div class="block-header">
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addcontribution">
            <span><i class="fa fa-plus"></i> Add Contribution</span>
        </button>
    </div>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Contributions List <span class="badge badge-primary">{{$contributions->count() }}</span></strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($contributions as $key=>$contribution)
                                      <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                           @foreach ($contribution->users as $user)
                                            {{ $user->first_name }} {{ $user->last_name }}
                                           @endforeach
                                        </td>
                                        <td>Ksh {{ $contribution->amount }}</td>
                                        <td>{{ $contribution->date }}</td>
                                        <td class="text-center">
                                           <p-button class="btn btn-info" type="submit" data-toggle="modal" data-target="#updatecontribution" style='background-color: transparent; border: none'>
                                             <i style='color:aqua' class="fa fa-pencil" [ngClass]="{'active': pinned}"></i>
                                           </p-button> |
                                           <p-button class="btn btn-danger" type="submit" style='background-color: transparent; border: none' onclick="deleteContribution({{ $contribution->id }})">
                                             <i style='color:red' class="fa fa-trash-o" [ngClass]="{'active': pinned}"></i>
                                           </p-button>
                                           <form id="delete-form-{{ $contribution->id }}" action="{{ route('contributions.destroy',$contribution->id) }}" method="POST" style="display: none;">
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
        function deleteContribution(id) {
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
             jQuery('#addcontribution-form').submit(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ route('contributions.store') }}",
                  method: 'post',
                  type: "POST",
                  // data: new FormData(this),
                  // processData: false,
                  // contentType: false,
                  data:$(this).serialize(),
                //   data: {
                //     first_name: jQuery('#first_name').val(),
                //     last_name: jQuery('#last_name').val(),
                //     id_number: jQuery('#id_number').val(),
                //     phone_no: jQuery('#phone_no').val(),
                //     email: jQuery('#email').val(),
                //     amount: jQuery('#amount').val(),
                //     image: jQuery('#image').val()
                //   },
                  success: function(result){
                    //  console.log(result);
                    //  jQuery('.alert').show();
                    // var r = JSON.parse(result);
                    //  alert(r.message);
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
                    title: 'Contribution Submitted successfully'
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