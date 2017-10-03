@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <a class="btn btn-block btn-primary" href="/addUser">Create New User</a>
            </div>
        <hr>
            <div class="col-md-4 col-md-offset-4">
                <a class="btn btn-block btn-primary" href="/departments">Show All Departments</a>
            </div>
        </div>
    </div>
            @endsection
               @push('scripts')
                   <script>
                       $(function() {
                           $('#users-table').DataTable({
                               processing: true,
                               serverSide: true,
                               ajax: '{!! route('datatables.data') !!}',
                               columns: [
                                   { data: 'id', name: 'id' },
                                   { data: 'name', name: 'name' },
                                   { data: 'surname', name: 'surname' },
                                   { data: 'email', name: 'email' },
                                   { data: 'dep_name', name: 'dep_name' },
                                   { data: 'address', name: 'address' },
                                   { data: 'action', name: 'action', orderable: false, searchable: false}
                               ]
                           });
                       });
                   </script>
               @endpush




