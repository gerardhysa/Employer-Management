@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">

                <div id="jstree">
                 {!! $tree !!}
                </div>
                <hr>
                <div class="row">

                    <a type="button" class="btn btn-block btn-primary" href="editDep"><i class="glyphicon glyphicon-plus-sign"></i>  Edit Departments  </a>

                </div>
            </div>
                <div class="col-md-10">
                    <table class="table table-bordered" id="users">
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
    </div>
@endsection

@push('scripts')

    <script type="text/javascript">

        $(function () {
        $("#jstree").jstree({
            data : "{{route('departments')}}",
            "plugins" : [ "wholerow" ]
        });
        });


        function usr(id) {
                        $('#users').DataTable(
                            {
                                columns:[
                                    {data: 'id', name: 'id'},
                                    {data: 'name', name: 'name'},
                                    {data: 'surname', name: 'surname'},
                                    {data: 'email', name: 'email'},
                                    {data: 'dep_name', name: 'dep_name'},
                                    {data: 'address', name: 'address'},
                                    {data: 'action', name: 'action', orderable: false, searchable: false}
                                ],
                                destroy: true,

                                ajax:function (data,callback,settings) {
                                    $.ajax({
                                        url:'depusers',
                                        type:'POST',
                                        contentType:"application/json; charset=UTF-8",
                                        dataType:"json",
                                        data:JSON.stringify({
                                            tableData:data,
                                            settings:settings,
                                            id:id

                                        }),
                                        success:function (result) {
                                            console.log(result);
                                            callback(result);
                                        }
                                    });
                                },
                                processing: true,
                                serverSide: true,
                                iDisplayLength: 10
                            })
        }

    </script>
@endpush
