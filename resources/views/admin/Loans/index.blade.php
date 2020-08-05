@extends('layouts.backend.app')
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
@section('title', 'Loans')

@push('css')

@endpush

@section('content')

{{-- Start Add Modal --}}
  
<div class="modal fade" id="addloan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Loan Request</h5>
        </div>
        <form action="#" method="POST" id="addloan-form" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                  <label for="first_name"><strong>First Name:</strong></label>
                  <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter the First Name" required>
              </div>
              <div class="form-group">
                  <label for="last_name"><strong>Last Name:</strong></label>
                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter the Last Name" required>
              </div>
              <div class="form-group">
                  <label for="id_number"><strong>ID / Passport No:</strong></label>
                  <input type="text" name="id_number" id="id_number" class="form-control" placeholder="Enter the ID / Passport No." required>
              </div>
              <div class="form-group">
                  <label for="phone_no"><strong>Phone No:</strong></label>
                  <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone No." required>
              </div>
              <div class="form-group">
                  <label for="email"><strong>Email Address:</strong></label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
              </div>
              <div class="form-group">
                  <label for="amount"><strong>Amount:</strong></label>
                  <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter the amount" required>
              </div>
              <div class="form-group">
                  <label for="image"><strong>ID / Passport Image:</strong></label>
                  <input type="file" name="image" id="image"> 
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="addloanRequest">Submit Request</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  
{{-- End Add Modal --}}

{{-- Start Edit Modal --}}
  
{{-- <div class="modal fade" id="editloan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Edit Loan Request</strong></h5>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <input type="hidden" name="loan_id" id="loan_id">
              <div class="form-group">
                  <label for="first_name"><strong>First Name:</strong></label>
                  <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter the First Name" required value="">
              </div>
              <div class="form-group">
                  <label for="last_name"><strong>Last Name:</strong></label>
                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter the Last Name" required value="">
              </div>
              <div class="form-group">
                  <label for="id_number"><strong>ID / Passport No:</strong></label>
                  <input type="text" name="id_number" id="id_number" class="form-control" placeholder="Enter the ID / Passport No." required value="">
              </div>
              <div class="form-group">
                  <label for="phone_no"><strong>Phone No:</strong></label>
                  <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone No." required value="">
              </div>
              <div class="form-group">
                  <label for="email"><strong>Email Address:</strong></label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="">
              </div>
              <div class="form-group">
                  <label for="amount"><strong>Amount:</strong></label>
                  <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter the amount" required value="">
              </div>
              <div class="form-group">
                  <label for="image"><strong>ID / Passport Image:</strong></label>
                  <input type="file" name="image" id="image">
                  <span id="store_image"></span>
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update Loan Information</button>
            </div>
        </form>
      </div>
    </div>
  </div> --}}
  
{{-- End Edit Modal --}}

<div>
    <div class="content">
        <div class="container-fluid row">
            <div class="block-header">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addloan">
                    <span><i class="fa fa-plus"></i> Add Loan Request</span>
                </button>
            </div> 

            <div class="block-header">
                <button class="btn btn-success btn-sm">
                    <span><i class="fa fa-thumbs-up"></i> Paid Loans</span>
                </button>
            </div> 
            <div class="block-header">
                <button class="btn btn-danger btn-sm">
                    <span><i class="fa  fa-exclamation-triangle"></i> Defaulted Loans</span>
                </button>
            </div> 
        </div>
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Active Loans List <span class="badge badge-primary"></strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th>ID Image</th> --}}
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>Phone No.</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Amount Borrowed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($loans as $key=>$loan)
                                       <tr>
                                           <td>{{ $key + 1 }}</td>
                                           {{-- <td><img class="user-avatar rounded-circle" src="{{ url('storage/loan/'.$loan->image) }}" width="50" height="50" alt="Loan Image"></td> --}}
                                           <td>{{ $loan->first_name }} {{ $loan->last_name }}</td>
                                           <td>{{ $loan->id_number }}</td>
                                           <td>{{ $loan->phone_no }}</td>
                                           <td>{{ $loan->email }}</td>
                                           <td>{{ $loan->created_at }}</td>
                                           <td>Ksh {{ $loan->amount }}.00</td>
                                           <td class="text-center">
                                             <a href=""><i class="fa fa-eye" style="color: lime"></i></a> |
                                             {{-- <p-button class="btn btn-info" type="submit"  data-toggle="modal" data-target="#editloan" style='background-color: transparent; border: none'>
                                                <i style='color:aqua' class="fa fa-pencil" [ngClass]="{'active': pinned}"></i>
                                              </p-button>  | --}}
                                            <a href="#" data-toggle="modal" data-target="#editloan"><i class="fa fa-pencil" style="color: aqua"></i></a> |
                                            <p-button class="btn btn-danger" type="submit" style='background-color: transparent; border: none' onclick="deleteLoan({{ $loan->id }})">
                                              <i style='color:red' class="fa fa-trash-o" [ngClass]="{'active': pinned}"></i>
                                            </p-button>
                                            <form id="delete-form-{{ $loan->id }}" action="{{ route('loans.destroy',$loan->id) }}" method="POST" style="display: none;">
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
</div>
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
     function deleteLoan(id) {
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
     }
     })
  }

  jQuery(document).ready(function(){
             jQuery('#addloan-form').submit(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ route('loans.store') }}",
                  method: 'post',
                  type: "POST",
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
                    title: 'Laon Request Submitted successfully'
                    });
                    setInterval('location.reload()', 1000);
                  }});
               });
            });
            
</script>
@endpush