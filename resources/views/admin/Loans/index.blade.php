@extends('layouts.backend.app')

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
        <form action="#" method="POST">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                  <label for="first_name"><strong>First Name:</strong></label>
                  <input type="text" name="first_name" class="form-control" placeholder="Enter the First Name" required>
              </div>
              <div class="form-group">
                  <label for="last_name"><strong>Last Name:</strong></label>
                  <input type="text" name="last_name" class="form-control" placeholder="Enter the Last Name" required>
              </div>
              <div class="form-group">
                  <label for="id_number"><strong>ID / Passport No:</strong></label>
                  <input type="text" name="id_number" class="form-control" placeholder="Enter the ID / Passport No." required>
              </div>
              <div class="form-group">
                  <label for="phone_no"><strong>Phone No:</strong></label>
                  <input type="text" name="phone_no" class="form-control" placeholder="Phone No." required>
              </div>
              {{-- <div class="form-group">
                  <label for="email"><strong>Email Address:</strong></label>
                  <input type="email" name="email" class="form-control" placeholder="Email Address">
              </div> --}}
              <div class="form-group">
                  <label for="amount"><strong>Amount:</strong></label>
                  <input type="text" name="amount" class="form-control" placeholder="Enter the amount" required>
              </div>
              <div class="form-group">
                  <label for="image"><strong>ID / Passport Image:</strong></label>
                  <input type="file" name="image">
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Submit Request</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  
{{-- End Add Modal --}}

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
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>Phone No.</th>
                                        {{-- <th>Email</th> --}}
                                        <th>Date</th>
                                        <th>Amount Borrowed</th>
                                        <th>Amount Returned</th>
                                        <th>Balance</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
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
<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
  } );
</script>
@endpush