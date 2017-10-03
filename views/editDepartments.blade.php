@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <form action="/storeNewDep" method="POST">

                <label>Department Name:</label>
                <input type="text" name="dep_name" class="form-control input-lg" value="">

                {{Form::label('department_id', 'Parent department: ')}}

                <select class="form-control input-lg" name="department_id">
                    @foreach($departments as $department)
                        <option value="{{$department->department_id}}">{{$department->dep_name}}</option>
                    @endforeach
                </select>
                <hr>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-success btn-block">
                </form>
            </div>


            <div class="col-md-4">
            <form name="myForm" action="">
                <label>Department Name: </label>

                <select id="e" class="form-control input-lg" name="department_id" onchange="test()">

                    @foreach($departments as $department)
                        <option value="{{$department->department_id}}">{{$department->dep_name}}</option>
                    @endforeach

                </select>
                <hr>

                <a id="link" class="btn btn-block btn-danger" ><i class="glyphicon glyphicon-remove"></i>  Delete Department  </a>
            </form>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>

    function test(myForm) {
   /* var i = document.getElementById('e').selected;*/
        var button = document.getElementById('link');
        button.setAttribute('href','');
        var e = document.getElementById("e");
        var selectedDep = e.options[e.selectedIndex].value;
        var url = '/deleteDep/'+selectedDep;
        button.setAttribute('href',url);

    }

    </script>
    @endpush